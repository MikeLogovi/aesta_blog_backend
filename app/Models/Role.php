<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{   
    use partage;
    public $fillable=['name'];
    public function users(){
        return $this->belongsToMany(App\User::class);
    }
}
