<?php
/**
 * Created by PhpStorm.
 * User: marcintofilski
 * Date: 05.04.2016
 * Time: 19:43
 */

namespace App\Http\Controllers;


use App\User_gallery;
use App\User_photos;
use Illuminate\Support\Facades\Auth;

class StorageController extends Controller
{
    public function files(){
        $userId = Auth::user()->id;
        $all_pictures = User_photos::where('author_id','=',$userId)->get();
        foreach ($all_pictures as $key => $val){
            $album_name = User_gallery::where('id',$val['gallery_id'])->first();
            $all_pictures[$key]['album_name'] = $album_name->gallery_name;
        }
        $data = array(
            'title' => 'All Photos',
            'album_pictures' => $all_pictures
        );
        return view('/storage/files', $data);
    }
}