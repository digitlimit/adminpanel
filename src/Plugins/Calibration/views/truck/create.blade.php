@extends('adminpanel::layouts.authenticated')

@section('content')
    <div class="content-wrapper">

        @include('adminpanel::partials.content-header')

        <section class="content">
            <div class="row">
                <form role="form" action="{{route('adminpanel.calibration.truck.postStore')}}" method="post" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="box box-primary">

                            <div class="box-body">
                                <div class="col-md-12">
                                    @include('adminpanel::partials.form-message')
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Model</label>
                                        <input type="text" class="form-control input-lg" id="model" name="model" value="{{old('model')}}" placeholder="Enter truck model">
                                    </div>
                                    <div class="form-group">
                                        <label for="detail">Truck No</label>
                                        <input type="text" class="form-control input-lg" id="reg_number" name="reg_number" value="{{old('reg_number')}}" placeholder="Enter truck number">
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Chassis No</label>
                                        <input type="text" class="form-control input-lg" id="chassis_number" name="chassis_number" value="{{old('chassis_number')}}" placeholder="Enter truck chassis number">
                                    </div>

                                    <div class="form-group">
                                        <label for="start_date">Volume</label>
                                        <input type="text" class="form-control input-lg" id="volume" name="volume" value="{{old('volume')}}" placeholder="Enter truck volume e.g. 33000">
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="col-md-12">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <a href="{{route('adminpanel.page.getIndex')}}" type="submit" class="btn btn-default btn-lg">Cancel</a>
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