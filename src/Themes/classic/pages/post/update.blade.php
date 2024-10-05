@extends('adminpanel::layouts.authenticated')

@section('content')
    <div class="content-wrapper">

        @include('adminpanel::partials.content-header')

        <section class="content">
            <div class="row">
                <form role="form" action="{{route('adminpanel.post.postUpdate',['id'=>$post->id])}}" method="post">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                Update Post
                            </div>

                            <div class="box-body">
                                <div class="col-md-12">
                                    @include('adminpanel::partials.form-message')
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Post Title</label>
                                        <input type="text" class="form-control input-lg" id="title" name="title" value="{{old('title') ? old('title') : $post->title}}" placeholder="Enter post title">
                                    </div>
                                    <div class="form-group">
                                        <label for="summary">Summary (Optional)</label>
                                        <input type="text" class="form-control input-lg" id="summary" name="summary" value="{{old('summary') ? old('summary') : $post->summary}}" placeholder="Post Summary">
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
                                </div>

                                <div class="col-md-6">
                                    <label for="published">Status</label>
                                    <select class="form-control input-lg" id="published" name="published">
                                        <option value="">Select Status</option>

                                        <?php if(!$published = old('published')) $published = $options['selected']['published']; ?>

                                        @foreach($options['published'] as $value=>$label)
                                            <option value="{{$value}}" {{$value == $published ? 'selected' : ''}}>{{$label}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content">Content (Write your post/article here)</label>
                                        <textarea name="content" id="content" class="form-control summernote">{{old('content') ? old('content') : $post->content}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="tags">Tags (Optional)</label>
                                        <input type="text" class="form-control input-lg" id="tags" name="tags" value="{{old('tags') ? old('tags') : $post->tags}}" placeholder="Post tags e.g. skills, forex">
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer">
                                <div class="col-md-12">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <a href="{{route('adminpanel.post.getIndex')}}" type="submit" class="btn btn-default btn-lg">Cancel</a>
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