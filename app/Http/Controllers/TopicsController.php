<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use Auth;
use willvincent\Rateable\Rating;

class TopicsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($forumId, $categoryId)
    { 
        return view('topics.create', compact('forumId', 'categoryId'));
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

        $topic = new Topic;
        $topic->title = $request->title;
        $topic->body = $request->body;
        $topic->user_id = Auth::user()->id;
        $topic->category_id = $categoryId;
        $topic->views = 1;
        $topic->save();

        return redirect()->route('topics.show', $topic->slug);


    }

/* resource nested di pisah supaya url show topic nya lebih bersih */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $topic = Topic::findBySlug($slug);
        $topic->views += 1;
        $topic->save();
        $comments = Topic::findBySlug($slug)->comments()->paginate(20);
        return view('topics.show', compact('topic', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $topic = Topic::findBySlug($slug);
        if ($topic->user->id == Auth::id()) {
          return view('topics.edit', compact('topic'));
        }

        return redirect()->back();
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
        $topic = Topic::findBySlug($slug);
        if (!$topic->user->id == Auth::id()) {
          return redirect()->back();
        }

        $this->validate($request, [
          'title' => 'required|max:50',
          'body' => 'required|max:10000',
        ]);

        $topic->update($request->all());

        return redirect()->route('topics.show', $topic->slug);
    }


    public function postStar(Request $request, $slug)
    {
        $topic = Topic::findBySlug($slug);
        $validate =  $topic->ratings()->where('user_id', \Auth::id())->first();

        if (count($validate)) {
          return 'Memberi rating hanya bisa di lakukan sekali';      
        } else {
          $rating = new Rating;
          $rating->rating = $request->rating;
          $rating->user_id = \Auth::id();
          $topic->ratings()->save($rating);

          return 'Thanks for rating';
        }

    }

}
