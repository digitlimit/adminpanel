@include('adminpanel::partials.header')

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

    @include('adminpanel::partials.main-header')

    @include('adminpanel::partials.main-sidebar')

    @yield('content')

    @include('adminpanel::partials.control-sidebar')

    <div class="control-sidebar-bg"></div>

</div>

@include('adminpanel::partials.footer')