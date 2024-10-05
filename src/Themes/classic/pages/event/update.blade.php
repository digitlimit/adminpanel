@extends('adminpanel::layouts.authenticated')

@section('content')
    <div class="content-wrapper">

        @include('adminpanel::partials.content-header')

        <section class="content">
            <div class="row">
                <form role="form" action="{{route('adminpanel.event.postUpdate', ['id'=>$event->id])}}" method="post">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                New Event
                            </div>

                            <div class="box-body">
                                <div class="col-md-12">
                                    @include('adminpanel::partials.form-message')
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Event Title</label>
                                        <input type="text" class="form-control input-lg" id="title" name="title" value="{{old('title') ? old('title') : $event->title}}" placeholder="Enter event title">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Event Venue</label>
                                        <input type="text" class="form-control input-lg" id="venue" name="venue" value="{{old('venue') ? old('venue') : $event->venue}}" placeholder="Enter event venue">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Starting date:</label>
                                        <div class="input-group input-group-lg date no-radius">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" placeholder="Starting date" class="datepicker form-control pull-right" id="start_date" name="start_date" value="{{old('start_date') ? old('start_date') : $event->start_date}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="end_date">Ending date:</label>
                                        <div class="input-group input-group-lg date no-radius">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" placeholder="Ending date" class="datepicker form-control pull-right" id="end_date" name="end_date" value="{{old('end_date') ? old('end_date') : $event->end_date}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label for="start_time">Starting time:</label>
                                            <div class="input-group input-group-lg no-radius">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input type="text" placeholder="Starting time" class="timepicker form-control pull-right" id="start_time" name="start_time" value="{{old('start_time') ? old('start_time') : $event->start_date}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label for="end_time">Ending time:</label>
                                            <div class="input-group input-group-lg no-radius">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input type="text" placeholder="Ending time" class="timepicker form-control pull-right" id="end_time" name="end_time" value="{{old('end_time') ? old('end_time') : $event->end_time}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <label for="detail">Tell us more about this event</label>
                                    <textarea name="detail" id="detail" class="form-control summernote">{{old('detail') ? old('detail') : $event->detail}}</textarea>
                                </div>

                            </div>
                            <div class="box-footer">
                                <div class="col-md-12">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <a href="{{route('adminpanel.event.getIndex')}}" type="submit" class="btn btn-default btn-lg">Cancel</a>
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