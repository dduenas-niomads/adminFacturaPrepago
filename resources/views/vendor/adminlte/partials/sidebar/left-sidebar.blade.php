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
                    <a href="#" class="nav-link @yield('nav-dashboard')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Panel de control
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/home" class="nav-link @yield('nav-overview')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Visión general</p>
                            </a>
                        </li>
                        @if ($user->role['code'] === 'super-admin')
                            <li class="nav-item">
                                <a href="/my-company" class="nav-link @yield('nav-company')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mi empresa</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="/my-account" class="nav-link @yield('nav-account')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mi cuenta</p>
                            </a>
                        </li>
                        @if ($licenseType === "LITE" && $user->role['code'] === 'super-admin')
                            <li class="nav-item">
                                <a href="/electronic-invoice" class="nav-link @yield('nav-electronic-invoice')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Facturación electrónica</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/warehouses" class="nav-link  @yield('nav-warehouses')">
                        <i class="fa fa-store-alt nav-icon "></i>
                        <p>Mis proveedores</p>
                    </a>
                </li>
            </ul>
            @if ($licenseType === "LITE")
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="/sales-report" class="nav-link  @yield('nav-sales-report')">
                            <i class="fa fa-chart-line nav-icon "></i>
                            <p>Reporte de ventas</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="/products" class="nav-link  @yield('nav-products')">
                            <i class="fa fa-box-open nav-icon "></i>
                            <p>Productos</p>
                        </a>
                    </li>
                </ul>

                @if ($user->role['code'] === 'super-admin')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview @yield('nav-inventory-menu')">
                        <a href="#" class="nav-link @yield('nav-inventory')">
                            <i class="nav-icon fas fa-dolly-flatbed"></i>
                            <p>
                                Inventarios
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/inventory-home" class="nav-link @yield('nav-inventory-home')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Resúmen de stock</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/inventory-movement" class="nav-link @yield('nav-inventory-movement')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Transferencias</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/inventory-kardex" class="nav-link @yield('nav-inventory-kardex')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Movimientos de kardex</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/inventory-remission-guide" class="nav-link @yield('nav-inventory-remission-guide')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Guías de remisión</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endif
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="/clients" class="nav-link  @yield('nav-clients')">
                            <i class="fa fa-heart nav-icon "></i>
                            <p>Clientes</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="/orders" class="nav-link  @yield('nav-orders')">
                            <i class="fa fa-clipboard-check nav-icon "></i>
                            <p>Pedidos</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="/sales" class="nav-link  @yield('nav-sales')">
                            <i class="fa fa-file-invoice nav-icon "></i>
                            <p>Ventas</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="/sales-ecommerce" class="nav-link  @yield('nav-sales-ecommerce')">
                            <i class="fa fa-shopping-cart nav-icon "></i>
                            <p>Comercio electrónico</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="/virus-data" class="nav-link  @yield('nav-virus-data')">
                            <i class="fa fa-virus nav-icon "></i>
                            <p>COVID-19 datos</p>
                        </a>
                    </li>
                </ul>
            @endif
            @if(env('fp'))
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="/upgrade" class="nav-link  @yield('nav-upgrade')">
                            <i class="fa fa-cubes nav-icon "></i>
                            <p>Planes y beneficios</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="/contact-support" class="nav-link  @yield('nav-contact-support')">
                            <i class="fa fa-headset nav-icon "></i>
                            <p>Soporte técnico</p>
                        </a>
                    </li>
                </ul>
            @endif
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