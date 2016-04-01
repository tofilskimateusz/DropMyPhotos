<?php

namespace App\Http\Controllers;

use App\Contracts\IntegrationInterface;
use Illuminate\Routing\Controller;


class IntegrationController extends Controller
{

    protected $serviceDriver;

    public function __construct(IntegrationInterface $interface){
        $this->serviceDriver = $interface;
    }

    public function showServiceAlbums(){
        $data = array(
            'albums' => $this->serviceDriver->showAlbums()
        );
        return view('integration/show',$data);
    }

    public function showServiceAlbumPictures($album_id){
        $data = array(
            'album_pictures' => $this->serviceDriver->showAlbumPictures($album_id)
        );
        return view('integration/album_pictures', $data);
    }
}
