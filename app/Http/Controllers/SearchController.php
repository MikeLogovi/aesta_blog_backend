<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Department;
use App\Models\Category;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request,$keywords){
       
        $keywords=explode(' ',$keywords);
         $results=collect([]);
         foreach($keywords as $keyword){
            $articles=Article::where('title', 'like', '%'.$keyword.'%')
            ->orWhere('description','like','%'.$keyword.'%')
            ->orWhere('htmlCode','like','%'.$keyword.'%')
            ->orWhere('created_at','like','%'.$keyword.'%')
                    ->get();
           if($articles->count()>0){
   
               $articles->load('user','department','category');
               $results=$results->concat($articles);
           }   
           
           $users=User::where('name','like','%'.$keyword.'%')->get();
           
           if($users->count()>0){
              
               
               foreach($users as $user){
                   $user->articles->load('department','category','user');
                   $results=$results->concat($user->articles);
               }
        
           }
           $departments=Department::where('name','like','%'.$keyword.'%')->get();
           if($departments->count()>0){
               
               foreach($departments as $department){
                   $department->articles->load('user','category','department');
                   $results=$results->concat($department->articles);
               }
        
           }
           $categories=Category::where('name','like','%'.$keyword.'%')->get();
           if($categories->count()>0){
               
               foreach($categories as $category){
                   $category->articles->load('user','category','department');
                   $results=$results->concat($category->articles);
               }
        
           }              
         }
         
        return $results;
    }
}
