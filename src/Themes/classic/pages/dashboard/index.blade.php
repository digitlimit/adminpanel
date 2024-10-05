@extends('adminpanel::layouts.authenticated')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
               @if(isset($dashboards)&& $dashboards)
                   @foreach($dashboards as $dashboard)
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box {{$dashboard->bg_class}}">
                                <div class="inner">
                                    <h3>{{$dashboard->count or 0}}</h3>

                                    <p>{{$dashboard->title}}</p>
                                </div>
                                {{--ion ion-ios-calendar-outline--}}
                                <div class="icon">
                                    <i class="{{$dashboard->icon}}"></i>
                                </div>
                                <a href="{{$dashboard->url}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                   @endforeach
               @endif
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection