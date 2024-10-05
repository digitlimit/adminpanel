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

            <li class="{{ adminpanel_routeIs('adminpanel.dashboard.index') ? "active" : "" }}">
                <a href="{{route('adminpanel.dashboard.index')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
                </a>
            </li>

            <li class="treeview {{ adminpanel_routeIs('adminpanel.plugin.getIndex') ? "active" : "" }}">
                <a href="{{route('adminpanel.plugin.getIndex')}}">
                    <i class="fa fa-plug"></i>
                    <span>Plugins</span>
                    {{--<span class="label label-primary pull-right">{{$dashboard['events_count'] or 0 }}</span>--}}
                </a>
            </li>

            @if(isset($sidebars))
                @foreach($sidebars as $link)
                    <li class="{{$link->active ? "active" : "" }}">
                        <a href="{{$link->url}}">
                            <i class="{{$link->icon}}"></i> <span>{{$link->title}}</span></i>
                            @if($link->has_menus)<i class="fa fa-angle-left pull-right"></i>@endif
                        </a>

                        @if($link->has_menus)
                            <ul class="treeview-menu active">
                                @foreach($link->sub_menu as $menu)
                                    <li class="{{$menu['active'] ? 'active' : ''}}">
                                        <a href="{{$menu['url']}}">
                                            <i class="{{$menu['icon']}}"></i> {{$menu['title']}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endif
        </ul>

    </section>
    <!-- /.sidebar -->
</aside>