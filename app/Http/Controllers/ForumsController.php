<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Forum;
use App\Thread;

class ForumsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $forum = Forum::findOrFail($id);
        // $threads = Thread::orderBy('created_at', 'DESC')->paginate(10);
        $threads = $forum->threads()->orderBy('created_at', 'DESC')->paginate(10);
        return view('forums.show', compact('forum', 'threads'));
    }

}
