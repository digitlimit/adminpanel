@extends('adminpanel::layouts.authenticated')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <i class="fa fa-certificate"></i> {{$page_title}}
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{$page_title}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <form name="users" method="post">
                    <div class="col-lg-12 col-xs-12">
                        <div class="box">
                            <div class="box-header">

                                <a href="{{route('adminpanel.calibration.getCreate')}}" class="btn btn-sm btn-default">
                                    <i class="fa fa-plus"></i> Add new
                                </a>

                                {{--<a href="{{route('adminpanel.calibration.calibration.getCreate')}}" class="btn btn-sm btn-default">--}}
                                    {{--<i class="fa fa-upload"></i> Upload new Calibration--}}
                                {{--</a>--}}
                                <a href="{{route('adminpanel.calibration.client.getCreate')}}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-user-plus"></i> Add new Client
                                </a>
                                <a href="{{route('adminpanel.calibration.transporter.getCreate')}}" class="btn btn-sm btn-success">
                                    <i class="fa fa-users"></i> Add new Transporter
                                </a>
                                <a href="{{route('adminpanel.calibration.truck.getCreate')}}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-truck"></i> Add new Truck
                                </a>

                                <div class="box-tools" style="margin-top: 5px;">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <table class="table table-hover table-condensed">
                                    <tr>
                                        <th style="width: 10px"></th>
                                        <th style="width: 20%">Client</th>
                                        <th style="width: 20%">Transporter</th>
                                        <th style="width: 30%">Chart No</th>
                                        <th></th>
                                    </tr>

                                    @foreach($calibrations as $calibration)
                                        <tr>
                                            <td><input name="events[]" value="{{$calibration->id}}" type="checkbox"></td>
                                            <td>{{$calibration->client ? $calibration->client->name : ''}}</td>
                                            <td>{{$calibration->transporter ? $calibration->transporter->name : ''}}</td>
                                            <td>{{$calibration->chart ? $calibration->chart->chart_no : ''}}</td>
                                            <td>
                                                <div class="action-buttons pull-right" style="margin-right: 5px;">

                                                    <a href="{{route('adminpanel.calibration.getUpdate', ['id'=>$calibration->id])}}" data-toggle="tooltip" title="Edit" type="button" class="btn btn-sm btn-success">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>

                                                    <a href="{{route('adminpanel.calibration.getDeleteConfirm', ['id'=>$calibration->id])}}" data-toggle="tooltip" title="Delete" type="button" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">

                                {{--{!! $calibrations->render() !!}--}}

                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">Action</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" calibration="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#"><i class="fa fa-pencil"></i> Send Email</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#"><i class="fa fa-user-times"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection