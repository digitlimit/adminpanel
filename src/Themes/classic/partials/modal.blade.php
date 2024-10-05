@if ( $adminpanel_modal = session('adminpanel_modal') )
    <div class="modal fade" id="alert-modal-message" tabindex="-1" role="dialog" aria-labelledby="alert-modal-message" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog {{isset($adminpanel_modal['size']) ? 'modal-'.$adminpanel_modal['size'] : ''}}">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    @if(isset($adminpanel_modal['title']))
                        <h4 class="modal-title  @if(isset($adminpanel_modal['status']))modal-{{$adminpanel_modal['status']}}@endif" id="alert-modal-message-title">
                            @if(isset($adminpanel_modal['icon']))<i class="{{$adminpanel_modal['icon']}}"></i>@endif
                            {{$adminpanel_modal['title']}}
                        </h4>
                    @endif
                </div>

                <div class="modal-body">
                    {!! $adminpanel_modal['message'] or '' !!}
                </div>

                <div class="modal-footer">
                    @if(isset($adminpanel_modal['close']))
                        <a href="{{$adminpanel_modal['close']['url']}}" type="button" class="btn btn-ar btn-default" data-dismiss="modal">
                            {{$adminpanel_modal['close']['label']}}
                        </a>
                    @endif

                    @if(isset($adminpanel_modal['action']))
                        <a href="{{$adminpanel_modal['action']['url']}}" type="button" class="btn btn-ar btn-primary">
                            {{$adminpanel_modal['action']['label']}}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        window.onload = function(){
            $('#alert-modal-message').modal('show');
        };
    </script>
@endif