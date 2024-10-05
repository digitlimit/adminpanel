@extends('adminpanel::layouts.authenticated')

@section('content')
    <div class="content-wrapper">

        @include('adminpanel::partials.content-header')

        <section class="content">
            <div class="row">
                <form role="form" action="{{route('adminpanel.calibration.client.postUpdate', ['id'=>$client->id])}}" method="post" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            {{--<div class="box-header with-border">--}}
                                {{--New Page--}}
                            {{--</div>--}}

                            <div class="box-body">
                                <div class="col-md-12">
                                    @include('adminpanel::partials.form-message')
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Client name</label>
                                        <input type="text" class="form-control input-lg" id="name" name="name" value="{{$client->name ? $client->name : old('name')}}" placeholder="Enter client name">
                                    </div>
                                    <div class="form-group">
                                        <label for="detail">Client Information</label>
                                        <textarea name="detail" id="detail" class="form-control summernote">{{$client->detail ? $client->detail : old('detail')}}</textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer">
                                <div class="col-md-12">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <a href="{{route('adminpanel.calibration.getIndex')}}" type="submit" class="btn btn-default btn-lg">Cancel</a>
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