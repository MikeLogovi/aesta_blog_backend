<?php

namespace App\Observers;

use App\Models\Article;

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
        if(in_array('admin',auth()->user()->roles()) || in_array('moderator',auth()->user()->roles())){
            $article->slug=str_slug($article->title);
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
        if(in_array('admin',auth()->user()->roles()) || in_array('moderator',auth()->user()->roles())){
            $article->slug=str_slug($article->title);
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
