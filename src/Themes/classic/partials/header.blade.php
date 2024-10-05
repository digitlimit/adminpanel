<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('adminpanel.name')}} {{isset($page_title) ? '| '.$page_title : ''}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{asset(config('adminpanel.assets') . 'bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset(config('adminpanel.assets') . 'plugins/font-awesome/css/font-awesome.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset(config('adminpanel.assets') . 'plugins/2.0.1-ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset(config('adminpanel.assets') . 'css/AdminLTE.css')}}">

    <link rel="stylesheet" href="{{asset(config('adminpanel.assets') . 'css/skins/_all-skins.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset(config('adminpanel.assets') . 'plugins/iCheck/flat/blue.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset(config('adminpanel.assets') . 'plugins/morris/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset(config('adminpanel.assets') . 'plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset(config('adminpanel.assets') . 'plugins/datepicker/datepicker3.css')}}">

    <link rel="stylesheet" href="{{asset(config('adminpanel.assets') . 'plugins/timepicker/bootstrap-timepicker.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset(config('adminpanel.assets') . 'plugins/daterangepicker/daterangepicker-bs3.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset(config('adminpanel.assets') . 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    <link rel="stylesheet" href="{{asset(config('adminpanel.assets') . 'plugins/summernote/dist/summernote.css')}}">

    <link rel="stylesheet" href="{{asset(config('adminpanel.assets') . 'css/app.css')}}">

    @stack('head')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
