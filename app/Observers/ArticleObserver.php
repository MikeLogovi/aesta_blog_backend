<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Str;
use App\User;
class ArticleObserver
{
    /**
     * Handle the article "created" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function creating(Article $article)
    {    $user=User::findOrFail(auth()->user()->id);
        $roles=$user->roles()->get();
        foreach($roles as $role){
            if('Moderator'==$role->name || 'Administrator'==$role->name)
                 $article->slug=Str::slug($article->title);
        }
        
    }

    /**
     * Handle the article "updated" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function updating(Article $article)
    {  
        $user=User::findOrFail(auth()->user()->id);
        $roles=$user->roles()->get();
        foreach($roles as $role){
            if('Moderator'==$role->name || 'Administrator'==$role->name)
                 $article->slug=Str::slug($article->title);
        }
    }

    /**
     * Handle the article "deleted" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function deleted(Article $article)
    {
        //
    }

    /**
     * Handle the article "restored" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function restored(Article $article)
    {
        //
    }

    /**
     * Handle the article "force deleted" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function forceDeleted(Article $article)
    {
        //
    }
}
