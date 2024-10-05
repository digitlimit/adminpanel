@extends('adminpanel::layouts.authenticated')

@section('content')
    <div class="content-wrapper">

        @include('adminpanel::partials.content-header')

        <section class="content">
            <div class="row">
                <form role="form" action="{{route('adminpanel.role.postStore')}}" method="post">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                New Roles
                            </div>

                            <div class="box-body">
                                <div class="col-md-12">
                                    @include('adminpanel::partials.form-message')
                                </div>

                                <div class="use-role use-role-appender">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Role Slug</label>
                                            <input type="text" class="form-control input-lg" id="name" name="role[name]" value="{{old('name')}}" placeholder="Role name e.g. create-user">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="display_name">Display name</label>
                                            <input type="text" class="form-control input-lg" id="display_name" name="role[display_name]" value="{{old('display_name')}}" placeholder="Display name e.g. Create User">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="display_name">Description</label>
                                            <input type="text" class="form-control input-lg" id="description" name="role[description]" value="{{old('description')}}" placeholder="Description e.g. Role can create new user">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer">
                                <div class="col-md-12">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <a href="{{route('adminpanel.role.getIndex')}}" type="submit" class="btn btn-default btn-lg">Cancel</a>
                                    <a type="submit" class="btn btn-default btn-lg append-btn"><i class="fa fa-plus"></i></a>

                                    <button type="submit" class="btn btn-primary btn-lg pull-right">Save</button>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <script type="text/javascript">
            window.onload = function(){
                var appender_count = 1;
                $('.append-btn').click(function(e){
                    ++appender_count;
                    alert(appender_count);
                    var append_html = $('.use-role-appender').html();
                    var appended = $('.use-role').append('<div>'+append_html+'</div>');
                });
            };
        </script>

    </div>
@endsection