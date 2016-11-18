<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;
use App\Category;
use App\Topic;
use Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = Forum::all();
        $categories = Category::all();
        $topics = Topic::orderBy('created_at', 'DESC')->limit(10)->get();
        return view('home.index', compact('forums', 'topics'));
    }

    public function createTopic()
    {

        // data for select optgroup
        $data = [];
        $categories = Category::all();
        foreach ($categories as $category) {
          $data[$category->forum->name][$category->id] = $category->name;
        }
        
        return view('home.create_topic', compact('data'));
    }

    public function storeTopic(Request $request)
    {
        $this->validate($request, [
          'category_id' => 'required',   
          'title' => 'required|max:50',
          'body' => 'required|max:10000',
          'g-recaptcha-response' => 'required'
        ]);        

        $data = $request->only(['category_id', 'title', 'body']);
        $data['user_id'] = Auth::user()->id;
        $data['views'] = 1;

        $topic = Topic::create($data);
        return redirect()->route('topics.show', $topic->slug);

    }


}
