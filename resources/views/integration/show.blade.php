@extends('home')

@section('content-page')
    <div class="elem-listing">
    @foreach($albums as $val)
        <div class="elem-single single-folder">
            <a href="/social/integrate/{{$serviceName}}/{{$val['id']}}">
                <div class="elem-picture">
                    <img src="{{$val['picture']['url']}}">
                </div>
                <span class="elem-text">{{$val['name']}}</span>
            </a>
        </div>
        @endforeach
    </div>
@endsection
