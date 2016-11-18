<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Forum;
use App\Category;
use Auth;
use PDF;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $forums = Forum::pluck('name', 'id');
        return view('admin.categories.create', compact('forums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required|unique:categories,name',
          'forum_id' => 'required'
        ]);

        $data            = $request->only(['name', 'forum_id']);
        $data['user_id'] = Auth::user()->id;


        Category::create($data);
        flash('Success create new Category');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $forums = Forum::pluck('name', 'id');

        return view('admin.categories.edit', compact('category', 'forums'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
          'name' => 'required',
          'forum_id' => 'required'
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        flash('Update success');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        flash("Success Destroy");
        return redirect()->route('admin.categories.index');
    }

    public function pdf()
    {
        $categories = Category::all();
        $pdf = PDF::loadView('admin.pdf.categories', ['categories' => $categories]);
        return $pdf->stream();
    }
}
