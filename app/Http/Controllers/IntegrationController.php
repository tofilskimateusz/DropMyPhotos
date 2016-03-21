<?php

namespace App\Http\Controllers;

use App\Contracts\IntegrationInterface;
use App\Http\Controllers\Social\FacebookController;


use App\Http\Requests;


class IntegrationController extends Controller
{

    public $serviceDriver;

    public function __construct(IntegrationInterface $interface){
        $this->serviceDriver = $interface;
    }

    public function showAlbums(){
        $data = array(
            'albums' => $this->serviceDriver->showAlbums()
        );
        return view('integration/show', $data);
    }

    public function showAlbumPictures($album_id){
        $data = array(
            'album_pictures' => $this->serviceDriver->showAlbumPictures($album_id)
        );
        return view('integration/album_pictures', $data);
    }
}
