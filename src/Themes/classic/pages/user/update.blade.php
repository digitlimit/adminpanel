@extends('adminpanel::layouts.authenticated')

@section('content')
    <div class="content-wrapper">

        @include('adminpanel::partials.content-header')

        <section class="content">
            <div class="row">
                <form role="form" action="{{route('adminpanel.user.postUpdate', ['id'=>$user->id])}}" method="post" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="box box-primary">

                            <div class="box-body">
                                <div class="col-md-12">
                                    @include('adminpanel::partials.form-message')
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control input-lg" id="name" name="name" value="{{old('name') ? old('name') : $user->name}}" placeholder="Enter name">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">New Password (Leave blank to retain old password)</label>
                                        <input type="password" class="form-control input-lg" id="password" name="password" value="" placeholder="Change password or leave blank">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control input-lg" id="email" name="email" value="{{old('email') ? old('email') : $user->email}}" placeholder="Enter email">
                                    </div>

                                    <div class="form-group">
                                        <label for="company">Company</label>
                                        <select class="form-control input-lg" id="company" name="company">
                                            @include('adminpanel::helper.select-options',[
                                                'default_label'=>'Select Company',
                                                'selected'=> old('company') ? old('company') : $user->company->id,
                                                'options' => $companies
                                            ])
                                        </select>
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