<?php

namespace App\Http\Controllers;

use App\Contracts\IntegrationInterface;
use App\User_gallery;
use App\User_photos;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class IntegrationController extends Controller
{

    protected $serviceDriver;

    public function __construct(IntegrationInterface $interface){
        $this->serviceDriver = $interface;
    }

    public function showServiceAlbums(){
        $data = array(
            'title' => 'Folders',
            'serviceName' => $this->serviceDriver->getServiceName(),
            'albums' => $this->serviceDriver->showAlbums()
        );
        return view('integration/show',$data);
    }

    public function showServiceAlbumPictures($album_id){
        $data = array(
            'title' => 'Folder Items',
            'serviceName' => $this->serviceDriver->getServiceName(),
            'album_pictures' => $this->serviceDriver->showAlbumPictures($album_id)
        );
        return view('integration/album_pictures', $data);
    }

    public function importPictures(Request $request){
        $response = $this->parseImportRequest($request);
        $userId = Auth::user()->id;
        $galleryId = $this->selectGalleryByName($this->serviceDriver->getServiceName(),$userId);

        DB::beginTransaction();
        foreach ($response as $key => $value) {
            if(User_photos::where('name', '=', $value['id'])->count() > 0){
                continue;
            }
            $attributes = array(
                'name' => $value['id'],
                'album_id' => $value['album']['id'],
                'gallery_id' => $galleryId,
                'link' => $value['images'][0]['source'],
                'link_thumb' => $value['images'][count($value['images'])-1]['source'],
                'created_original' => $value['created_time']->format('Y-m-d H:i:s'),
                'author_id' => $userId
            );

            if( ! User_photos::create($attributes)){
                DB::rollBack();
                return redirect('/social/integrate/fail');
            };
        }
        DB::commit();
        return redirect('/social/integrate/success');

    }
    protected function parseImportRequest($request){
        $selectedPhotos = $request->all();
        $response = $this->serviceDriver->showAlbumPictures($request->input('album_id'));
        foreach ($response as $key => $value){
            if( ! array_search($value['id'], $selectedPhotos)){
                unset($response[$key]);
            }
        }
        return $response;
    }

    protected function selectGalleryByName($servicename, $userId){
        $gallery =  User_gallery::where('user_id', '=', $userId)->where('gallery_name', '=', $servicename)->first();
        return $gallery->id;
    }
}
