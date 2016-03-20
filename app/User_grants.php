<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_grants extends Model
{
    protected $table = 'user_grants';

    protected $fillable = [ 'id', 'user_id', 'facebook_id', 'instagram_id', 'flickr_id', 'googledrive_id' ];
}
