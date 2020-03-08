<?php
namespace App\Models;

trait partage{
    public function getRouteKeyName(){
        return 'slug';
    }
}