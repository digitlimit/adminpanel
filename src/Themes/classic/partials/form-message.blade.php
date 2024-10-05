@if ($adminpanel_form = session('adminpanel_form'))
    <div class="alert alert-{{$adminpanel_form['status'] or 'success'}}" style="display: block;">

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        @if(isset($adminpanel_form['title']) || isset($adminpanel_form['icon']))
            <strong>
                @if(isset($adminpanel_form['icon']))<i class="{{$adminpanel_form['icon']}}"></i>@endif
                @if(isset($adminpanel_form['title'])){{$adminpanel_form['title']}}@endif
            </strong>
        @endif

        {!! $adminpanel_form['message'] !!}
    </div>
@endif

@if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif