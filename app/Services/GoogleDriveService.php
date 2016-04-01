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
    
    
    public function showAlbums()
    {
        $optParams = array(
            'corpus' => 'domain',
            'orderBy' => 'folder',
            'q' => 'mimeType = \'application/vnd.google-apps.folder\' AND trashed = FALSE',
            'fields' => 'files(createdTime,name,parents,webContentLink)'
        );
        $photos = $this->getUserProfile('files', $optParams);
        foreach ($photos as $photo){
            echo $photo['name'].'<br/>';
        }
        //return $photos;
    }

    public function showAlbumPictures($album_id)
    {
        // TODO: Implement showAlbumPictures() method.
    }
}