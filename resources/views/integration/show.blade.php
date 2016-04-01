@extends('home')

@section('content-page')
    <h2>Pokaż album</h2>
    <ul>
        {{var_dump($albums)}}
    {{--@foreach($albums as $val)--}}
        {{--<li>--}}
            {{--<div>--}}
                {{--<a href="/social/integrate/facebook/{{$val['id']}}">{{$val['name']}}>--}}
                {{--<img src="{{$val['picture']['url']}}">--}}
            {{--</div>--}}
        {{--</li>--}}
    {{--@endforeach--}}
    </ul>
@endsection
