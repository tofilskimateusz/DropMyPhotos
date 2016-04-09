@extends('home')

@section('content-page')
        <ul id="photoList" class="elem-listing">
            @foreach($album_pictures as $key => $val)
                <li class="elem-single single-photo">
                    <div class="elem-picture">
                        <img src="{{$val['link_thumb']}}">
                    </div>
                    <a href="#" data-toggle="modal" data-link="{{$val['link']}}" data-created-time="{{$val['created_original']}}" data-import-time="{{$val['created_at']}}" data-updated-time="{{$val['updated_at']}}" data-album-name="{{$val['album_name']}}" data-target="#imageDescription"><i class="fa fa-info-circle"></i></a>
                    <a href="#" id="deletePhotos"><i class="fa fa-trash-o"></i></a>

                </li>
            @endforeach
        </ul>
        <!-- Modal -->
        <div class="modal fade" id="imageDescription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Image Description</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-8 ">
                                <img src="" id="imageFullModal" class="img-responsive">
                            </div>
                            <div class="col-xs-4">
                                <div class="modal-properties">
                                    <ul>
                                        <li>Created time: <span id="createdTimeModal"></span></li>
                                        <li>Imported time: <span id="importedTimeModal"></span></li>
                                        <li>Updated time: <span id="updatedTimeModal"></span></li>
                                        <li>Album name: <span id="albumNameModal"></span></li>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('additional_scripts')

@endsection

