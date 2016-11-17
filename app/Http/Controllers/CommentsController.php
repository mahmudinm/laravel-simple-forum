<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Comment;
use Auth;

class CommentsController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($topicSlug)
    {
        return view('comments.create', compact('topicSlug'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $topicSlug)
    {
        $this->validate($request, [
          'body' => 'required|max:10000',
          'g-recaptcha-response' => 'required'
        ]);

        $comment = new Comment;
        $comment->body = $request->body;
        $comment->user_id = Auth::user()->id;
        $topic = Topic::findBySlug($topicSlug);

        $topic->comments()->save($comment);
        // redirect to last page
        $lastPage = Topic::findBySlug($topicSlug)->comments()->paginate(15)->lastPage();

        flash("Success create new comment");
        return redirect()->route('topics.show', [$topic->slug, 'page' => (int)$lastPage]);
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($topicSLug, $id)
    {
        // return request('page');
        $topic  = Topic::findBySlug($topicSLug);
        $comment = Comment::find($id);
        return view('comments.edit', compact('topic', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $topicSlug, $id)
    {
        $this->validate($request, [
          'body' => 'required'
        ]);

        $topic  = Topic::findBySlug($topicSlug);
        $comment = Comment::find($id);
        $comment->update($request->all());

        flash("Success update comment");
        return redirect()->route('topics.show', [$topic->slug, 'page' => request('page')]);
    }
}
