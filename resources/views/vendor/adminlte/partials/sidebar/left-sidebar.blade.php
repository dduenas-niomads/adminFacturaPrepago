<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-gray elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
        <img src="/img/logo.png" alt="{{ env('APP_NAME') }} Logo" 
            class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        @php
            $user = \Auth::user();
            $licenseType = $user->active_license['license']['type'];
            $dateEnd = $user->active_license['date_end'];
        @endphp
        @if(env('fp')) 
        <!-- 9 1 5 2 7 -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <nav class="mt-2 w-100">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            @if ($licenseType === "FREE")
                                <a href="/upgrade" class="nav-link bg-danger">
                                    <style>
                                        .involved-share:before {
                                            content: '{{ $licenseType }} hasta {{ $dateEnd }}';
                                        }
                                        .involved-share:hover:before {
                                            content: 'Mejorar plan!';
                                        }
                                    </style>
                                    <i class="nav-icon fas fa-power-off"></i>
                                    <p class="involved-share w-100"></p>
                                </a>
                            @elseif ($licenseType === "LITE")
                                <a href="/upgrade" class="nav-link bg-warning">
                                    <style>
                                        .involved-share:before {
                                            content: '{{ $licenseType }} hasta {{ $dateEnd }}';
                                        }
                                        .involved-share:hover:before {
                                            content: 'Ir más lejos!';
                                        }
                                    </style>
                                    <i class="nav-icon fas fa-power-off"></i>
                                    <p class="involved-share w-100"></p>
                                </a>
                            @else
                                <a href="/upgrade" class="nav-link bg-success">
                                    <style>
                                        .involved-share:before {
                                            content: '{{ $licenseType }} until {{ $dateEnd }}';
                                        }
                                        .involved-share:hover:before {
                                            content: 'Ir más lejos!';
                                        }
                                    </style>
                                    <i class="nav-icon fas fa-power-off"></i>
                                    <p class="involved-share w-100"></p>
                                </a>
                            @endif
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview @yield('nav-dashboard-menu')">
                    <a href="/sales-report" class="nav-link @yield('nav-sales-report')">
                        <i class="fa fa-receipt nav-icon"></i>
                        <p>Facturación electrónica</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/sales-ecommerce" class="nav-link  @yield('nav-sales-ecommerce')">
                        <i class="fa fa-shopping-cart nav-icon "></i>
                        <p>Listado de ventas</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        <nav class="mt-2" style=" bottom: 0;">
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <p>© 2020 {{ env('APP_NAME') }}</p>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>