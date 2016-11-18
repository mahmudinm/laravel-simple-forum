<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth;
use Session;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $currentUserId = Auth::user()->id;

        // All threads, ignore deleted/archived participants
        // $threads = Thread::getAllLatest()->get();

        // All threads that user is participating in
        $threads = Thread::forUser($currentUserId)->latest('updated_at')->get();

        // All threads that user is participating in, with new messages

        return view('message.index', compact('threads', 'currentUserId'));
    }

    public function show($profileId, $id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect()->route('profile.show', $profileId);
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list

        // check if true participant pass to the thread
        $userId = Auth::user()->id;
        if ($thread->hasParticipant($userId)) {        
          $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();
          $thread->addParticipant($profileId);
          $thread->markAsRead($userId);
          return view('message.show', compact('profileId','thread', 'users'));        
        } else {
          return redirect('/');
        }
    }

    public function create($profileId)
    {
        $user = User::findOrFail($profileId);
        return view('message.create', compact('user'));
    }

    public function store(Request $request, $profileId)
    {
        $this->validate($request, [
            'subject' => 'required|max:120',
            'message' => 'required|max:10000'
        ]);


        $thread = Thread::create(
            [
                'subject' => $request->subject,
            ]
        );

        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $request->message,
            ]
        );

        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon,
            ]
        );

        return redirect()->route('profile.message.show', [$profileId, $thread->id]);
    }

    public function update(Request $request, $profileId, $id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect('message');
        }

        $thread->activateAllParticipants();

        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => $request->message,
            ]
        );

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if ($request->recipients) {
            $thread->addParticipants($request->recipients);
        }

        return redirect()->route('profile.message.show', [$profileId, $id]);
    }

}
