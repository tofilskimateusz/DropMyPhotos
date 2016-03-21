@extends('home')

@section('content-page')
    <h2>Zdjęcia albumu</h2>
    <ul>
        <a href="{{'/social/integrate/facebook/show_albums'}}">Powrót</a>
        @foreach($album_pictures as $val)
            <li>
                <div>
                    <a href="{{$val['images'][0]['source']}}"><img src="{{$val['images'][count($val['images'])-1]['source']}}"></a>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
