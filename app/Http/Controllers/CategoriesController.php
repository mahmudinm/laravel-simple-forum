<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $forumId, $categoryId
     * @return \Illuminate\Http\Response
     */
    public function show($forumId, $categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $threads = $category->threads()->orderBy('created_at', 'DESC')->paginate(10);        
        return view('categories.show', compact('category', 'threads', 'forumId', 'categoryId'));
    }

}
