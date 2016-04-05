<?php
/**
 * Created by PhpStorm.
 * User: marcintofilski
 * Date: 21.03.2016
 * Time: 21:06
 */

namespace App\Services;


use App\Contracts\IntegrationInterface;
use App\Http\Controllers\Social\FacebookController;

class FacebookService extends FacebookController implements IntegrationInterface
{
    public function getServiceName()
    {
        return "facebook";
    }

    public function showAlbums(){
        $photos = $this->getUserProfile(['albums{name,picture,id}']);

        return $photos['albums'];
    }

    public function showAlbumPictures($album_id){
        $photos = $this->getUserProfile(['photos{id,images,created_time,album}'], $album_id);
        
        return $photos['photos'];
    }

}