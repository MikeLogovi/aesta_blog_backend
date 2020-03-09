<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Str;
class ArticleObserver
{
    /**
     * Handle the article "created" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function creating(Article $article)
    {
        $article->slug=Str::slug($article->title);
        /*if(in_array('admin',auth()->user()->roles()) || in_array('moderator',auth()->user()->roles())){
        }*/
    }

    /**
     * Handle the article "updated" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function updating(Article $article)
    {
        $article->slug=Str::slug($article->title);
        /*if(in_array('admin',auth()->user()->roles()) || in_array('moderator',auth()->user()->roles())){
        }*/
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
