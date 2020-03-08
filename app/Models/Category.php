<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    use partage;
    public $fillable=['name','slug'];
    public function articles(){
        return $this->hasMany(App\Models\Department::class);
    }
  
}
