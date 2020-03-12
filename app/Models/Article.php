<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function getRouteKeyName(){
        return 'slug';
    }
    public $fillable=['title','slug','picture','htmlCode','description','likes'];
    public function category(){
        return $this->belongsTo(\App\Models\Category::class);
    }
    public function department(){
        return $this->belongsTo(\App\Models\Department::class);
    }
    public function user(){
        return $this->belongsTo(\App\User::class);
    }
    
}
