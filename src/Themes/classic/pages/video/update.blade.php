@extends('adminpanel::layouts.authenticated')

@section('content')
    <div class="content-wrapper">

        @include('adminpanel::partials.content-header')

        <section class="content">
            <div class="row">
                <form role="form" action="{{route('adminpanel.video.postUpdate', ['id'=>$video->id])}}" method="post" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="box box-primary">

                            <div class="box-body">
                                <div class="col-md-12">
                                    @include('adminpanel::partials.form-message')
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Video Title</label>
                                        <input type="text" class="form-control input-lg" id="title" name="title" value="{{old('title') ? old('title') : $video->title}}" placeholder="Enter video title">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Upload</label>
                                        <input type="file" class="form-control input-lg" id="video" name="video" value="{{old('video')}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Youtube Video ID (Optional)</label>
                                        <input type="text" class="form-control input-lg" id="youtube" name="youtube" value="{{old('youtube') ? old('youtube') : $video->youtube}}" placeholder="Enter video youtube">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Privacy (Optional)</label>
                                        <select class="form-control input-lg" id="privacy" name="privacy" value="">
                                            @if(old('privacy') || $video->privacy)
                                                <option value="{{old('privacy') ? old('privacy') : $video->privacy}}" selected>{{old('privacy') ? old('privacy') : $video->privacy}}</option>
                                            @endif
                                            <option value="public">Public - Anyone can view this Video</option>
                                            <option value="members">Members - Only registered members</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="detail">Detail (Tell us more about this video)</label>
                                    <textarea name="detail" id="detail" class="form-control summernote">{{old('detail') ? old('detail') : $video->detail}}</textarea>
                                </div>

                            </div>

                            <div class="box-footer">
                                <div class="col-md-12">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <a href="{{route('adminpanel.video.getIndex')}}" type="submit" class="btn btn-default btn-lg">Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-lg pull-right">Save</button>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection