<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <span class="brand-text font-weight-light">INFO | JDU</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @can('home-index')
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ Request::is('admin/home*') ? "active":'' }}">
                            <i class="fa fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                @endcan

                {{--@can('link-index')--}}
                    <li class="nav-item">
                        <a href="" class="nav-link {{ Request::is('admin/sms*') ? "active":'' }}">
                            <i class="fa fa-sms"></i>
                            <p>Sms Management</p>
                        </a>
                    </li>
                {{--@endcan--}}

                {{--@can('link-index')--}}
                    <li class="nav-item">
                        <a href="{{ route('link.index') }}" class="nav-link {{ Request::is('admin/link*') ? "active":'' }}">
                            <i class="fa fa-link"></i>
                            <p>Links</p>
                        </a>
                    </li>
                {{--@endcan--}}

                {{--@can('link-index')--}}
                    <li class="nav-item">
                        <a href="{{ route('student.index') }}" class="nav-link {{ Request::is('admin/student*') ? "active":'' }}">
                            <i class="fa fa-people-arrows"></i>
                            <p>Students</p>
                        </a>
                    </li>
                {{--@endcan--}}

                {{--@can('link-index')--}}
                    <li class="nav-item">
                        <a href="{{ route('record.index') }}" class="nav-link {{ Request::is('admin/record*') ? "active":'' }}">
                            <i class="fa fa-record-vinyl"></i>
                            <p>Records</p>
                        </a>
                    </li>
                {{--@endcan--}}

                @canany(['role-index','user-index'])
                    <li class="nav-item {{ (Request::is('admin/roles*') or Request::is('admin/permissions*') or Request::is('admin/user*')) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ (Request::is('admin/roles*') or Request::is('admin/permissions*') or Request::is('admin/user*')) ? 'active' : '' }}">
                            <i class="nav-icon fa fa-cog"></i>
                            <p>
                                Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('user-index')
                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Admins</p>
                                    </a>
                                </li>
                            @endcan

                            @can('role-index')
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('admin/roles*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
