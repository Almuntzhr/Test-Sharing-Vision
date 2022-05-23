<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','content','category', 'status', 'created_at','updated_at'];

    static function getPublish(){

        return Post::where('status', '=', 'publish')->get()->count();
    }

    static function getDraft(){

        return Post::where('status', '=', 'draft')->get()->count();
    }

    static function getTrash(){

        return Post::where('status', '=', 'trash')->get()->count();
    }
}

