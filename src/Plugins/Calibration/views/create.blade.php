@extends('adminpanel::layouts.authenticated')

@section('content')
    <div class="content-wrapper">

        @include('adminpanel::partials.content-header')

        <section class="content">
            <div class="row">
                <form role="form" action="{{route('adminpanel.calibration.postStore')}}" method="post" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="box box-primary">

                            <div class="box-body">
                                <div class="col-md-12">
                                    @include('adminpanel::partials.form-message')
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Calibration Title</label>
                                            <input type="text" class="form-control input-lg" id="title" name="title" value="{{old('title')}}" placeholder="Enter calibration title">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="detail">Truck</label>
                                        <select class="form-control input-lg" id="truck" name="truck">
                                            @include('adminpanel::helper.select-options',[
                                                'default_label'=>'Select Truck',
                                                'selected'=> old('truck'),
                                                'options' => $trucks
                                            ])
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="detail">Transporter</label>
                                        <select class="form-control input-lg" id="transporter" name="transporter">
                                            @include('adminpanel::helper.select-options',[
                                                'default_label'=>'Select Transporter',
                                                'selected'=> old('transporter'),
                                                'options' => $transporters
                                            ])
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="start_date">Issued date</label>
                                        <div class="input-group input-group-lg date no-radius">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" placeholder="Issued date" class="datepicker form-control pull-right" id="issued_date" name="issued_date" value="{{old('issued_date')}}" style="border-radius: 0;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="detail">Client/Customer</label>
                                        <select class="form-control input-lg" id="client" name="client">
                                            @include('adminpanel::helper.select-options',[
                                                'default_label'=>'Select Client',
                                                'selected'=> old('client'),
                                                'options' => $clients
                                            ])
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="detail">Chart Number</label>
                                        <input type="text" class="form-control input-lg" id="chart_no" name="chart_no" value="{{old('chart_no')}}" placeholder="Enter chart no">
                                    </div>

                                    <div class="form-group">
                                        <label for="detail">Upload Chart</label>
                                        <input type="file" class="form-control input-lg" id="chart" name="chart" value="{{old('chart')}}" placeholder="Select chart">
                                    </div>

                                    <div class="form-group">
                                        <label for="start_date">Expiry Date</label>
                                        <div class="input-group input-group-lg date no-radius">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" placeholder="Expiry Date" class="datepicker form-control pull-right" id="expiry_date" name="expiry_date" value="{{old('expiry_date')}}" style="border-radius: 0;">
                                        </div>
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