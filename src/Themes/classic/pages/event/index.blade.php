@extends('adminpanel::layouts.authenticated')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{$page_title}}
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
                                <a href="{{route('adminpanel.event.getCreate')}}" class="btn btn-sm btn-default"><i class="fa fa-plus-circle"></i> Add new</a>

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

{{--                               @include('adminpanel::partials.alerts')--}}
                                <div style="margin: 10px;">
                                    @include('adminpanel::partials.form')
                                    @include('adminpanel::partials.form-message')
                                </div>

                                <table class="table table-hover table-condensed">
                                    <tr>
                                        <th style="width: 10px"></th>
                                        <th style="width: 30px">ID</th>
                                        <th style="width: 20%">Title</th>
                                        <th style="width: 10%">Venue</th>
                                        <th style="width: 15%">Starts</th>
                                        <th style="width: 15%">Ends</th>
                                        <th style="width: 30px">Status</th>
                                        <th></th>
                                    </tr>

                                    @foreach($events as $event)
                                        <tr>
                                            <td><input name="events[]" value="{{$event->id}}" type="checkbox"></td>
                                            <td>{{$event->id}}</td>
                                            <td>{{$event->title}}</td>
                                            <td>{{$event->venue}}</td>
                                            <td>
                                                {{$event->start_date}} {{$event->start_time}}
                                            </td>
                                            <td>
                                                {{$event->end_date}} {{$event->end_time}}
                                            </td>
                                            <td>
                                                @if($event->status == 2)<span class="label label-success">Over</span>@endif
                                                @if($event->status == 1)<span class="label label-warning">Ongoing</span>@endif
                                                @if(!$event->status)<span class="label label-default">Upcoming</span>@endif
                                            </td>
                                            <td>
                                                <div class="action-buttons pull-right" style="margin-right: 5px;">
                                                    <a href="{{route('adminpanel.event.getUpdate', ['id'=>$event->id])}}" data-toggle="tooltip" title="Edit" type="button" class="btn btn-sm btn-success">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>

                                                    <a href="{{route('adminpanel.event.getDeleteConfirm', ['id'=>$event->id])}}" data-toggle="tooltip" title="Delete" type="button" class="btn btn-sm btn-danger">
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
                                {{--<ul class="pagination pagination-sm no-margin pull-right">--}}
                                {{--<li><a href="#">&laquo;</a></li>--}}
                                {{--<li><a href="#">1</a></li>--}}
                                {{--<li><a href="#">2</a></li>--}}
                                {{--<li><a href="#">3</a></li>--}}
                                {{--<li><a href="#">&raquo;</a></li>--}}
                                {{--</ul>--}}

                                {!! $events->render() !!}

                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">Action</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
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