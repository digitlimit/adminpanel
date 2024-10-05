@extends('adminpanel::layouts.authenticated')

@section('content')
    <div class="content-wrapper">

        @include('adminpanel::partials.content-header')

        <section class="content">
            <div class="row">
                <form role="form" action="{{route('adminpanel.page.postStore')}}" method="post" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                New Page
                            </div>

                            <div class="box-body">
                                <div class="col-md-12">
                                    @include('adminpanel::partials.form-message')
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Page Title</label>
                                        <input type="text" class="form-control input-lg" id="title" name="title" value="{{old('title')}}" placeholder="Enter page title">
                                    </div>
                                    <div class="form-group">
                                        <label for="summary">Summary (Optional)</label>
                                        <input type="text" class="form-control input-lg" id="summary" name="summary" value="{{old('summary')}}" placeholder="Page Summary">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Published date (Optional)</label>
                                        <div class="input-group input-group-lg date no-radius">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" placeholder="Published date" class="datepicker form-control pull-right" id="published_date" name="published_date" value="{{old('published_date')}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="published">Status</label>
                                        <select class="form-control input-lg" id="published" name="published">
                                            <option value="">Select Status</option>

                                            <?php if(!$published = old('published')) $published = $options['selected']['published']; ?>

                                            @foreach($options['published'] as $value=>$label)
                                                <option value="{{$value}}" {{$value == $published ? 'selected' : ''}}>{{$label}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_keywords">Keywords (Optional)</label>
                                        <input type="text" class="form-control input-lg" id="meta_keywords" name="meta_keywords" value="{{old('meta_keywords')}}" placeholder="Page keywords separate with comma e.g. first aid, skills">
                                    </div>

                                    <div class="form-group">
                                        <label for="icon">Icon Class (Optional)</label>
                                        <input type="text" class="form-control input-lg" id="icon" name="icon" value="{{old('icon')}}" placeholder="e.g. fa fa-home">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Privacy (Optional)</label>
                                        <select class="form-control input-lg" id="privacy" name="privacy">
                                            <?php if(!$privacy = old('privacy')) $privacy = $options['selected']['privacy']; ?>

                                            @foreach($options['privacy'] as $value=>$label)
                                                <option value="{{$value}}" {{$value == $privacy ? 'selected' : ''}}>{{$label}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="main_image">Banner Image (Optional)</label>
                                        <input type="file" class="form-control input-lg" id="main_image" name="main_image">
                                    </div>

                                    <div class="form-group">
                                        <label>Page Template (Optional)</label>
                                        <select class="form-control input-lg" id="template" name="template">
                                            <option value="">Select Template</option>
                                            @if(is_array($options['template']))
                                                @foreach($options['template'] as $value=>$label)
                                                    <option value="{{$value}}" {{($value == old('template')) ? 'selected' : ''}}>{{$label}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Parent Page (Optional)</label>
                                        <select class="form-control input-lg" id="parent" name="parent">
                                            <option value="">Select Page</option>
                                            <?php if(!$parent = old('parent')) $parent = $options['selected']['parent']; ?>
                                            @if(is_array($options['parent']))
                                                @foreach($options['parent'] as $value=>$label)
                                                    <option value="{{$value}}" {{$value == $parent ? 'selected' : ''}}>{{$label}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content">Page Content (Content to display on page)</label>
                                        <textarea name="content" id="content" class="form-control summernote">{{old('content')}}</textarea>
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