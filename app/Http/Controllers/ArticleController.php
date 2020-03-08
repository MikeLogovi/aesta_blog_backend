<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Department;
use App\Models\Article;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $articles=Article::orderBy('updated_at','DESC')->get();
        return view('articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isModerator');
        $this->validate($request,[
            'title'=>'required|unique:articles',
            'picture'=>'required|file|image',
            'pdf'=>'required|file|pdf',
            'htmlCode'=>'required'
        ]);
        if($request->hasfile('picture')&& $request->file('picture')->isValid()){
            $path=fileUpload($request->file('picture'),'articles_img');
            $article->picture=$path;
        }
        if($request->hasfile('pdf')&& $request->file('pdf')->isValid()){
            $path=fileUpload($request->file('pdf'),'articles_pdf');
            $article->pdf=$path;
        }
        if(!empty($request->categoryId)){
            $category=  Category::findOrFail($request->categoryId);
            $article->category_id=$category->id;
        }
        $user=User::findOrFail($request->userId);
        $department=Department::findOrfail($request->departmentId);

        $article = new Article;
        $article->title=$request->title;
        $article->htmlCode=$request->htmlCode;
        $article->department_id=$department->id;
        $user->articles()->save($article);
        session()->flash('Message', 'Article created successfully');
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
        $article=Article::findOrFail($id);
        return view('article.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article=Article::findOrFail($id);
        return view('articles.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('isModerator');
        if(!empty($request->title)){
            $this->validate($request,[
                'title'=>'unique:articles'
            ]);
            $article->title=$request->title;
        }
        if(!empty($request->picture)){
            $path=unlinkAndUpload($request->file('picture'),$article->picture,'articles');
            $article->picture=$path;
        }
        if(!empty($request->pdf)){
            $path=unlinkAndUpload($request->file('pdf'),$article->pdf,'articles_pdf');
            $article->pdf=$path;
        }
        if(!empty($request->htmlCode))
            $article->htmlCode=$request->htmlCode;
        if(!empty($request->categoryId)){
            $category=  Category::findOrFail($request->categoryId);
            $article->category_id=$category->id;
        }
        if(!empty($request->departmentId)){
            $department=Department::findOrfail($request->departmentId);
            $article->department_id=$department->id;
            
        }
        if(!empty($request->userId)){
            $user=User::findOrFail($request->userId);
            $article->user_id=$user->id;
        }
        $article->save();
        session()->flash('Message', 'Article created successfully');
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
        $article=Article::findOrFail($id);
        Storage::disk('public')->delete($article->picture);
        $article->delete();
        session()->flash('Message', 'Article destroyed successfully');
        return redirect()->back();
    }
}
