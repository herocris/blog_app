<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function getRouteKeyName()
    {
        return 'name';

    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function users(){ // relacion entre usuarios y categorias
        return $this->belongsToMany(User::class,'category_user','category_id','user_id');
    }
}
