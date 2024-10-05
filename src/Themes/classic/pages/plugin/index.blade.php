@extends('adminpanel::layouts.authenticated')

@section('content')
    <div class="content-wrapper">
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
                                <a href="{{route('adminpanel.plugin.getCreate')}}" class="btn btn-sm btn-default"><i class="fa fa-plus-circle"></i> Add new</a>
                                <a href="{{route('adminpanel.plugin.getOther')}}" class="btn btn-sm btn-warning"><i class="fa fa-dot-circle-o"></i> Others</a>

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

                                <div style="margin: 10px;">
                                    @include('adminpanel::partials.form-message')
                                </div>

                                <table class="table table-hover table-condensed">
                                    <tr>
                                        <th style="width: 10px"></th>
                                        <th style="width: 20%">Plugin</th>
                                        <th style="width: 60%">Description</th>
                                        <th style="width: 30px">Status</th>
                                        <th></th>
                                    </tr>

                                    @foreach($plugins as $plugin)
                                        <tr>
                                            <td><input name="posts[]" value="{{$plugin->id}}" type="checkbox"></td>
                                            <td>{{$plugin->name}}</td>
                                            <td>{{$plugin->description}}</td>
                                            <td>
                                                @if($plugin->active)<span class="label label-success">Active</span>@endif
                                                @if(!$plugin->active)<span class="label label-default">Not active</span>@endif
                                            </td>
                                            <td>
                                                <div class="action-buttons pull-right" style="margin-right: 5px;">

                                                    @if(!$plugin->active)
                                                        <a href="{{route('adminpanel.plugin.getActivate',['id'=>$plugin->id])}}" data-toggle="tooltip" title="Activate" type="button" class="btn btn-sm btn-default">
                                                            <i class="fa fa-check-circle"></i>
                                                        </a>
                                                    @endif

                                                    @if($plugin->active)
                                                        <a href="{{route('adminpanel.plugin.getDeactivate',['id'=>$plugin->id])}}" data-toggle="tooltip" title="Deactivate" type="button" class="btn btn-sm btn-warning">
                                                            <i class="fa fa-chain-broken"></i>
                                                        </a>
                                                    @endif

                                                    {{--{{route('adminpanel.plugin.getUpdate', ['id'=>$plugin->id])}}--}}
                                                    <a href="#" data-toggle="tooltip" title="Edit" type="button" class="btn btn-sm btn-success">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>

                                                    <a href="{{route('adminpanel.plugin.getDeleteConfirm', ['id'=>$plugin->id])}}" data-toggle="tooltip" title="Delete" type="button" class="btn btn-sm btn-danger">
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
                                {{--{!! $pages->render() !!}--}}

                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">Action</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a></li>
                                        {{--<li><a href="#"><i class="fa fa-pencil"></i> Send Email</a></li>--}}
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