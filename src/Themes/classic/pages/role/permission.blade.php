@extends('adminpanel::layouts.authenticated')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{$page_title}}
                {{--<small>Control panel</small>--}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{$page_title}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <form name="users" action="{{route('adminpanel.role.postPermissions', ['name'=>$role->name])}}" method="post">
                    <div class="col-lg-12 col-xs-12">
                        <div class="box">
                            <div class="box-header">

                                <a href="#" class="btn btn-sm btn-default"><i class="fa fa-plus-circle"></i> Add new</a>

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

                                @if(session('form_error'))
                                    <div class="alert alert-danger">
                                        {{session('form_error')}}
                                    </div>
                                @elseif(session('form_success'))
                                    <div class="alert alert-success">
                                        {{session('form_success')}}
                                    </div>
                                @endif

                                <table class="table table-hover table-condensed">
                                    <tr>
                                        <th style="width: 10px"></th>
                                        <th style="width: 30px">ID</th>
                                        <th style="width: 20%">Name</th>
                                        <th style="width: 20%">Display name</th>
                                        <th style="width: 25%">Description</th>
                                        <th style="width: 80px;">
                                            <input class="pull-left check-all-permissions" type="checkbox">
                                            <div class="pull-right">Enabled</div>
                                        </th>
                                        <th></th>
                                    </tr>

                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td><input name="ids[]" value="{{$permission->id}}" type="checkbox"></td>
                                            <td>{{$permission->id}}</td>
                                            <td>{{$permission->name}}</td>
                                            <td>{{$permission->display_name}}</td>
                                            <td>{{$permission->description}}</td>
                                            <td><input name="permissions[]" class="permission-checkbox" value="{{$permission->id}}" @if(in_array($permission->id, $role_permissions)) checked="true" @endif type="checkbox"></td>
                                            <td>
                                                <div class="action-buttons pull-right" style="margin-right: 5px;">
                                                    <button data-toggle="tooltip" title="Edit" type="button" class="btn btn-sm btn-success">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>

                                                    <button data-toggle="tooltip" title="Delete" type="button" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-times"></i>
                                                    </button>
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

                                {{--{!! $permissions->render() !!}--}}
                                <button type="submit" class="btn btn-default pull-right">Save</button>

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

                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <script type="text/javascript">
            window.onload = function(){
                $('.check-all-permissions').click(function(){
                    var elm = $('.permission-checkbox');
                    if(elm.prop('checked')){
                        $('.permission-checkbox').prop('checked','');
                    }else{
                        $('.permission-checkbox').prop('checked','checked');
                    };
                });
            };
        </script>
        <!-- /.content -->
    </div>
@endsection