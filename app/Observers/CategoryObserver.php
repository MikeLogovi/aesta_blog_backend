<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;
class CategoryObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function creating(Category $category)
    {
        $category->slug=Str::slug($category->name);
        /*if(in_array('admin',auth()->user()->roles()) || in_array('moderator',auth()->user()->roles())){
        }*/
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updating(Category $category)
    {
        $category->slug=Str::slug($category->name);
        /*if(in_array('admin',auth()->user()->roles()) || in_array('moderator',auth()->user()->roles())){
        }*/
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        //
    }

    /**
     * Handle the category "restored" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the category "force deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
