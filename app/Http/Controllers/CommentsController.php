<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Comment;
use Auth;

class CommentsController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($threadSlug)
    {
        return view('comments.create', compact('threadSlug'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $threadSlug)
    {
        $this->validate($request, [
          'body' => 'required|max:10000',
          'g-recaptcha-response' => 'required'
        ]);

        $comment = new Comment;
        $comment->body = $request->body;
        $comment->user_id = Auth::user()->id;
        $thread = Thread::findBySlug($threadSlug);

        $thread->comments()->save($comment);
        // redirect to last page
        $lastPage = Thread::findBySlug($threadSlug)->comments()->paginate(15)->lastPage();

        flash("Success create new comment");
        return redirect()->route('threads.show', [$thread->slug, 'page' => (int)$lastPage]);
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($threadSLug, $id)
    {
        // return request('page');
        $thread  = Thread::findBySlug($threadSLug);
        $comment = Comment::find($id);
        return view('comments.edit', compact('thread', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $threadSlug, $id)
    {
        $this->validate($request, [
          'body' => 'required'
        ]);

        $thread  = Thread::findBySlug($threadSlug);
        $comment = Comment::find($id);
        $comment->update($request->all());

        flash("Success update comment");
        return redirect()->route('threads.show', [$thread->slug, 'page' => request('page')]);
    }
}
