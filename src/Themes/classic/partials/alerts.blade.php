@if(session('alert_success'))
    <div class="alert alert-success" style="margin:10px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{session('alert_success')}}
    </div>
@elseif(session('alert_error'))
    <div class="alert alert-warning" style="margin:10px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{session('alert_error')}}
    </div>
@endif