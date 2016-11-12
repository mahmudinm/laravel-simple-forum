<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $forumId, $categoryId
     * @return \Illuminate\Http\Response
     */
    public function show($forumId, $categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return view('categories.show', compact('category', 'forumId', 'categoryId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $forumId, $categoryId
     * @return \Illuminate\Http\Response
     */
    public function edit($forumId, $categoryId)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $forumId, $categoryId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $forumId, $categoryId)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $forumId, $categoryId
     * @return \Illuminate\Http\Response
     */
    public function destroy($forumId, $categoryId)
    {
        //
    }
}
