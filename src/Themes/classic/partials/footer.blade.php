<!-- ./wrapper -->
@include('adminpanel::partials.modal')

<!-- jQuery 2.2.0 -->
<script src="{{asset(config('adminpanel.assets') . 'plugins/jQuery/jQuery-2.2.0.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset(config('adminpanel.assets') . 'plugins/jQueryUI/jquery-ui.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset(config('adminpanel.assets') . 'bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<script src="{{asset(config('adminpanel.assets') . 'plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset(config('adminpanel.assets') . 'plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset(config('adminpanel.assets') . 'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset(config('adminpanel.assets') . 'plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset(config('adminpanel.assets') . 'plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

<script src="{{asset(config('adminpanel.assets') . 'plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset(config('adminpanel.assets') . 'plugins/datepicker/bootstrap-datepicker.js')}}"></script>

<script src="{{asset(config('adminpanel.assets') . 'plugins/timepicker/bootstrap-timepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset(config('adminpanel.assets') . 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset(config('adminpanel.assets') . 'plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset(config('adminpanel.assets') . 'plugins/fastclick/fastclick.js')}}"></script>

<script src="{{asset(config('adminpanel.assets') . 'plugins/summernote/dist/summernote.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset(config('adminpanel.assets') . 'js/app.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset(config('adminpanel.assets') . 'js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset(config('adminpanel.assets') . 'js/demo.js')}}"></script>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>

@stack('foot')

</body>
</html>
