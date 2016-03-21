<?php
/**
 * Created by PhpStorm.
 * User: marcintofilski
 * Date: 21.03.2016
 * Time: 20:50
 */

namespace App\Contracts;

interface IntegrationInterface {
    public function showAlbums();
    public function showAlbumPictures($album_id);
}