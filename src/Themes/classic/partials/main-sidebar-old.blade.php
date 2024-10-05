<aside class="main-sidebar">
    <section class="sidebar">

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>

        <ul class="sidebar-menu">
            {{--<li class="header">MAIN NAVIGATION</li>--}}
            <li class="{{ Request::is('/') ? "active" : "" }}">
                <a href="{{route('adminpanel.dashboard.index')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
                </a>
            </li>

            <li class="treeview {{ Request::is('*/users') ? "active" : "" }}">
                <a href="{{route('adminpanel.user.getIndex')}}">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                    <span class="label label-primary pull-right">{{$dashboard['users_count'] or 0 }}</span>
                </a>
            </li>


            <li class="treeview {{Request::is('*/calibrations') ? 'menu-open active' : ''}}" >
                <a href="#">
                    <i class="fa fa-lock"></i> <span>Calibrations</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{Request::is('*/roles') ? 'active' : ''}}">
                        <a href="{{route('adminpanel.role.getIndex')}}"><i class="fa fa-tags"></i> Transporters</a>
                    </li>
                    <li class="{{Request::is('*/permissions') ? 'active' : ''}}">
                        <a href="{{route('adminpanel.permission.getIndex')}}"><i class="fa fa-key"></i> Trucks</a>
                    </li>
                    <li class="{{Request::is('*/permissions') ? 'active' : ''}}">
                        <a href="{{route('adminpanel.permission.getIndex')}}"><i class="fa fa-key"></i> Charts</a>
                    </li>
                </ul>
            </li>


            <li class="treeview {{ Request::is('*/pages') ? "active" : "" }}">
                <a href="{{route('adminpanel.page.getIndex')}}">
                    <i class="fa fa-copy"></i>
                    <span>Pages</span>
                    <span class="label label-primary pull-right">{{$dashboard['pages_count'] or 0 }}</span>
                </a>
            </li>

            <li class="treeview {{ Request::is('*/posts') ? "active" : "" }}">
                <a href="{{route('adminpanel.post.getIndex')}}">
                    <i class="fa fa-clipboard"></i>
                    <span>Posts</span>
                    <span class="label label-primary pull-right">{{$dashboard['posts_count'] or 0 }}</span>
                </a>
            </li>

            <li class="treeview {{ Request::is('*/videos') ? "active" : "" }}">
                <a href="{{route('adminpanel.video.getIndex')}}">
                    <i class="ion ion-ios-videocam"></i>
                    <span>Videos</span>
                    <span class="label label-primary pull-right">{{$dashboard['videos_count'] or 0 }}</span>
                </a>
            </li>

            <li class="treeview {{ Request::is('*/newsletters') ? "active" : "" }}">
                <a href="{{route('adminpanel.newsletter.getIndex')}}">
                    <i class="fa fa-send-o"></i>
                    <span>Newsletters</span>
                    <span class="label label-primary pull-right">{{$dashboard['newsletters_count'] or 0 }}</span>
                </a>
            </li>

            <li class="treeview {{ Request::is('*/events') ? "active" : "" }}">
                <a href="{{route('adminpanel.event.getIndex')}}">
                    <i class="ion ion-ios-calendar-outline"></i>
                    <span>Events</span>
                    <span class="label label-primary pull-right">{{$dashboard['events_count'] or 0 }}</span>
                </a>
            </li>

            <li class="treeview {{ Request::is('*/plugins') ? "active" : "" }}">
                <a href="{{route('adminpanel.plugin.getIndex')}}">
                    <i class="fa fa-plug"></i>
                    <span>Plugins</span>
                    {{--<span class="label label-primary pull-right">{{$dashboard['events_count'] or 0 }}</span>--}}
                </a>
            </li>

            @stack('sidebar')

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>