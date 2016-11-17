<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Forum;
use App\Topic;

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
        $topics = $forum->topics()->orderBy('created_at', 'DESC')->paginate(10);
        return view('forums.show', compact('forum', 'topics'));
    }

}
