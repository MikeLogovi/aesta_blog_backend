<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use partage;
    public $fillable=['title','slug','picture','htmlCode',];
    public function category(){
        return $this->belongsTo(App\Models\Category::class);
    }
    public function department(){
        return $this->belongsTo(App\Models\Department::class);
    }
    public function user(){
        return $this->belongsTo(App\User::class);
    }
    
}
