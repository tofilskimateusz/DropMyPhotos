@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="menu-left">
                        <div class="menu-left-header">
                            Integracja
                        </div>
                        <ul>
                            <li><a href="/social/integrate/facebook">Połącz z Facebook</a></li>
                            <li><a href="/social/integrate/instagram">Połącz z Instagramem</a></li>
                            <li><a href="/social/integrate/flickr">Połącz z Flickr</a></li>
                            <li><a href="/social/integrate/googledrive">Połącz z Google Drive</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Content</div>

                <div class="panel-body">
                    @yield('content-page')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
