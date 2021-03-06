<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return view('categories.index',compact('categories'));
    }
    public function indexApi(){
        $categories=Category::with('articles')->orderBy('updated_at','DESC')->get();
        return $categories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->authorize('isAuthorized');
        $this->validate($request,[
            'name'=>'required|unique:categories'
        ]);
        $category = new Category;
        $category->name=$request->name;
        $category->user_id=auth()->user()->id;
        $category->save();
        session()->flash('Message', 'Category created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category=Category::findOrFail($id);
        $articles=$category->articles();
        return view('categories.show',compact('category','articles'));
    }
    public function showApi(Request $request,$slug){
        $category=Category::with('articles')->where('slug',$slug)->first();
        $category->articles->load('user','department');
        return $category;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('categories.edit');
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
        $this->authorize('isAuthorized');
        $category=Category::findOrFail($id);
        if(!empty($request->name)){
            $this->validate($request,[
                'name'=>'unique:categories'
            ]);
            $category->name=$request->name;
            $category->save();
            session()->flash('Message', 'Category updated successfully');

        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAuthorized');
        $category=Category::findOrFail($id);
        $category->delete();
        session()->flash('Message', 'Category deleted successfully');
        return redirect()->back();
    }
}
