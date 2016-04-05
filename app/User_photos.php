<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_photos extends Model
{
    protected $table = 'user_photos';

    protected $fillable = [ 'id', 'name', 'album_id', 'gallery_id', 'link', 'link_thumb', 'created_original', 'author_id' ];
}
