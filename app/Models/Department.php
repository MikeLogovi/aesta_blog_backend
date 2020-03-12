<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use partage;
    public $fillable=['name','slug','picture'];
    public function articles(){
        return $this->hasMany(\App\Models\Article::class);
    }
}
