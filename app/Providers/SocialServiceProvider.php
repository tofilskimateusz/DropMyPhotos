<?php

namespace App\Providers;

use Faker\Provider\Base;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;


class SocialServiceProvider extends ServiceProvider
{
    /**
     * Available Services
     * @var array
     */
    protected $services = ['Facebook','Googledrive'];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindContainers();


    }

    protected function getServiceNameFromUrl($url){
        $parsed = parse_url($url, PHP_URL_PATH);
        $parsed_array = explode('/', $parsed);
        return ucfirst($parsed_array[3]);
    }

    protected function bindContainers(){
            $foundService = array_search($this->getServiceNameFromUrl(url()->current()),$this->services);
            if($foundService !== FALSE)
                $this->app->bind('App\Contracts\IntegrationInterface', 'App\Services\\' . $this->services[$foundService] . 'Service');

    }
}
