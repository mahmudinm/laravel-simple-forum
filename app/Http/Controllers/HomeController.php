<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;
use App\Category;
use App\Thread;
use Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = Forum::all();
        $categories = Category::all();
        $threads = Thread::orderBy('created_at', 'DESC')->limit(10)->get();
        return view('home.index', compact('forums', 'threads'));
    }

    public function createThread()
    {

        // data for select optgroup
        $data = [];
        $categories = Category::all();
        foreach ($categories as $category) {
          $data[$category->forum->name][$category->id] = $category->name;
        }
        
        return view('home.create_thread', compact('data', 'eat_options'));
    }

    public function storeThread(Request $request)
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

        $thread = Thread::create($data);
        return redirect()->route('threads.show', $thread->slug);

    }


}
