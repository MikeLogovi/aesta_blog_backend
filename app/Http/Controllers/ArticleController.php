<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Department;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $users=User::all();
        $departments=Department::all();
        $categories=Category::all();
        $articles=Article::orderBy('updated_at','DESC')->get();
        return view('articles.index',compact('articles','departments','categories','users'));
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
        $this->authorize('isAuthorized');
        $this->validate($request,[
            'title'=>'required|unique:articles',
            'picture_link'=>'required',
            'pdf_link'=>'required',
            'description'=>'required',
            'userId'=>'required',
            'departmentId'=>'required'
        ]);
        $article = new Article;
        if($request->hasfile('picture')&& $request->file('picture')->isValid()){
            $path=fileUpload($request->file('picture'),'articles_img');
            $article->picture=$path;
        }
        if($request->hasfile('pdf')&& $request->file('pdf')->isValid()){
            $file=$request->file('pdf');
            $article->pdf=$file->store('public/storage/articles_pdf');
        }
        if(!empty($request->categoryId)){
            $category=  Category::findOrFail($request->categoryId);
            $article->category_id=$category->id;
        }
        $user=User::findOrFail($request->userId);
        $department=Department::findOrfail($request->departmentId);

       
        $article->title=$request->title;
        $article->description=$request->description;
        $article->department_id=$department->id;
        $article->pdf_link=$request->pdf_link;
        $article->picture_link=$request->picture_ink;
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
    public function edit(Request $request,$id)
    {
        $this->authorize('isAuthorized');
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
        $this->authorize('isAuthorized');
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
        if(!empty($request->picture_link)){
            $article->picture=$request->picture_link;
        }
        if(!empty($request->pdf_link)){
            $article->pdf_link=$request->pdf_link;
        }
        if(!empty($request->pdf)){
            Storage::delete($article->pdf);
            $file=$request->file('pdf');
            $article->pdf=$file->store('public/storage/articles_pdf');
        }
        if(!empty($request->description))
            $article->description=$request->description;
        if(!empty($request->categoryId)){
            $category=  Category::findOrFail($request->categoryId);
            $article->category_id=$category->id;
        }else
           $article->category_id=null;
        if(!empty($request->departmentId)){
            $department=Department::findOrfail($request->departmentId);
            $article->department_id=$department->id;
            
        }
        if(!empty($request->userId)){
            $user=User::findOrFail($request->userId);
            $article->user_id=$user->id;
        }
        $article->save();
        session()->flash('Message', 'Article updated successfully');
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
        $article=Article::findOrFail($id);
        if($article->picture)
            Storage::disk('public')->delete($article->picture);
        $article->delete();
        session()->flash('Message', 'Article destroyed successfully');
        return redirect()->back();
    }
    public function setHtmlCode(Request $request,$id){
        $article=Article::findOrFail($id);
        if(!empty($request->htmlCode)){
            $article->htmlCode=$request->htmlCode;
        }
        if(!empty($request->jsonCode)){
           
            $article->jsonCode=$request->jsonCode;
        }
        $article->save();
        session()->flash('Message', 'Article written successfully');

        return ['success'];
    }
    public function getJsonCode(Request $request,$id){
       $article=Article::findOrFail($id);
       return response()->json($article);
    }
    public function downloadPdf(Request $request,$id){
        $article=Article::findOrFail($id);
        $a=explode('/',$article->pdf);
        return Storage::download($article->pdf);
    }
    public function getSlideArticles(Request $request){
        $departments=Department::all();
        $array=[];
        foreach($departments as $department){
            $articles=Article::where('department_id',$department->id)->orderBy('updated_at','DESC')->limit(2)->get();
            $articles->load('user','category','department');
            array_push($array,$articles);
        }
        return response()->json($array);
    }
    public function homePageArticles(Request $request){
        $articles=Article::orderBy('created_at','DESC')->limit(7)->get();
        $articles->load('user','category','department');
        return $articles;
    }
    public function getApiDepartment(Request $request,$slug){
          $department=Department::with('articles')->where('slug',$slug)->first();
          $department->articles->load('user');
          return $department;
    }
    public function getApiArticle(Request $request,$slug){
          $article=Article::where('slug',$slug)->first();
          $article->load('user','department','category');
          return $article;
    }
    public function setLikes(Request $request,$id){
        $article=Article::findOrFail($id);
        $article->likes++;
        $article->save();
        return $article;
    }
    public function getPopularArticles(Request $request){
        $articles=Article::orderBy('likes','DESC')->limit(4)->get();
        $articles->load('department');
        return $articles;
    }
}
