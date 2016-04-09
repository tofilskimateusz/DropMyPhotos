<?php
/**
 * Created by PhpStorm.
 * User: marcintofilski
 * Date: 22.03.2016
 * Time: 20:26
 */

namespace App\Services;


use App\Contracts\IntegrationInterface;
use App\Http\Controllers\Social\GoogleDriveController;

class GoogleDriveService extends GoogleDriveController implements IntegrationInterface
{
    
    public function getServiceName()
    {
       return "googledrive";
    }

    public function showAlbums()
    {
        $optParams = array(
            'corpus' => 'domain',
            'orderBy' => 'folder',
            'q' => 'mimeType = \'application/vnd.google-apps.folder\' AND trashed = FALSE AND \'root\' IN parents ',
            'fields' => 'files(createdTime,name,parents)'
        );
        $photos = $this->getUserProfile('files', $optParams);
        $photos = $this->parseShowAlbumResponse($photos);
        var_dump($photos);
        return $photos;
    }

    public function showAlbumPictures($album_id)
    {
        // TODO: Implement showAlbumPictures() method.
    }

    private function parseShowAlbumResponse($photos){
        $newPhotos = $photos;
        foreach ($photos as $key => $val){
            $newPhotos[$key]['name'] = $val['name'];
            $newPhotos[$key]['created_time'] = $val['createdTime'];
        }
        return $newPhotos;
    }
}