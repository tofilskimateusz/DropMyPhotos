@extends('home')

@section('content-page')
    <a href="/social/integrate/{{$serviceName}}/">Back</a>
   <form action="{{url('social/integrate/'.$serviceName.'/import_pictures')}}" method="POST" id="importPicturesForm">
       <div class="form-header text-right">
           <a href="#" id="selectAllPhotos">select all</a>
           <a href="#" id="deselectAllPhotos" style="display:none">deselect all</a>
           <button id="btnSubmit" type="submit" class="btn btn-primary">Import</button>

       </div>
       <ul id="importElements" class="elem-listing">
        @foreach($album_pictures as $key => $val)
            <li class="elem-single single-photo">
                    <div class="elem-picture">
                        <img src="{{$val['images'][count($val['images'])-1]['source']}}" data-full-size="{{$val['images'][0]['source']}}">

                    </div>
                    <div class="elem-selection">
                        <input type="checkbox" id="picture-{{$key}}" value="{{$val['id']}}" name="picture-{{$key}}">
                    </div>
                <a href="{{$val['images'][0]['source']}}" class="fullImage"><i class="fa fa-search-plus"></i></a>
            </li>
        @endforeach
        </ul>
       <input type="hidden" name="album_id" value="{{$val['album']['id']}}">
       {{ csrf_field() }}
   </form>
@endsection
@section('additional_scripts')
    <script>
        $('.fullImage').fancybox();
    </script>
@endsection

