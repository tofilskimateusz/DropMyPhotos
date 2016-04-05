@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-5">
            <div class="panel panel-default">
                <div class="panel-heading">Sync social media</div>

                <div class="panel-body">
                    <ul class="nav nav-stacked">
                        <li role="presentation" class="active"><a href="/social/integrate/facebook"><i class="fa fa-2x fa-facebook"></i> Connect with Facebook</a></li>
                        <li role="presentation"><a href="/social/integrate/instagram"><i class="fa fa-2x fa-instagram"></i> Connect with Instagram</a></li>
                        <li role="presentation"><a href="/social/integrate/flickr"><i class="fa fa-2x fa-flickr"></i> Connect with Flickr</a></li>
                        <li role="presentation"><a href="/social/integrate/googledrive"><i class="fa fa-2x fa-google"></i> Connect with GoogleDrive</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-8 col-sm-7">
            <div class="panel panel-default">
                <div class="panel-heading">{{$title}}</div>

                <div class="panel-body">
                    @yield('content-page')
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
