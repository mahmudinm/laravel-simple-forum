<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use Auth;
use willvincent\Rateable\Rating;

class ThreadsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('threads.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($forumId, $categoryId)
    { 
        return view('threads.create', compact('forumId', 'categoryId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $forumId, $categoryId)
    {
        $this->validate($request, [
          'title' => 'required|max:50',
          'body' => 'required|max:10000',
          'g-recaptcha-response' => 'required'
        ]);

        $thread = new Thread;
        $thread->title = $request->title;
        $thread->body = $request->body;
        $thread->user_id = Auth::user()->id;
        $thread->category_id = $categoryId;
        $thread->views = 1;
        $thread->save();

        return redirect()->route('threads.show', $thread->slug);


    }

/* resource nested di pisah supaya url show thread nya lebih bersih */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $thread = Thread::findBySlug($slug);
        $comments = Thread::findBySlug($slug)->comments()->paginate(20);
        return view('threads.show', compact('thread', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $thread = Thread::findBySlug($slug);
        return view('threads.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $thread = Thread::findBySlug($slug);
        $this->validate($request, [
          'title' => 'required|max:50',
          'body' => 'required|max:10000',
        ]);

        $thread->update($request->all());

        return redirect()->route('threads.show', $thread->slug);
    }


    public function postStar(Request $request, $slug)
    {
        $thread = Thread::findBySlug($slug);
        $validate =  $thread->ratings()->where('user_id', \Auth::id())->first();

        if (count($validate)) {
          return 'Memberi rating hanya bisa di lakukan sekali';      
        } else {
          $rating = new Rating;
          $rating->rating = $request->rating;
          $rating->user_id = \Auth::id();
          $thread->ratings()->save($rating);

          return 'Thanks for rating';
        }

    }

}
