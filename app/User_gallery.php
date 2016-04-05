<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_gallery extends Model
{
    protected $table = 'user_gallery';

    protected $fillable = [ 'id', 'user_id', 'gallery_name', 'gallery_visible_name'];
}
