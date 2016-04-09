<?php
/**
 * Created by PhpStorm.
 * User: marcintofilski
 * Date: 05.04.2016
 * Time: 17:02
 */

namespace App\Http\Controllers;


use Illuminate\Routing\Controller;

class NotifyController extends Controller
{
    protected $types;

    /**
     * NotifyController constructor.
     * @param array $types
     */
    public function __construct()
    {
        $this->types = array('success', 'warning', 'error');
    }


    protected function returnMessage($data){
        $data['title'] = 'Message';
        if(in_array($data['type'], $this->types) == FALSE)
            return 0;
        return view('notify/index', $data);

    }

    public function importSuccess(){
        $data = array(
            'message' => 'Import pictures successfuly added to your album!',
            'header' => 'Import Pictures',
            'type' => 'success',
            'redirect_uri' => '/storage/files/'
        );

        return $this->returnMessage($data);
    }
}