<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="brand-link">
        <img src="{{ asset('admin-panel/images/logo.png') }}" alt="Logo" class="brand-text font-weight-light"
            style="opacity: .8">
        {{-- <span class="brand-text font-weight-light">Admin Panel</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin-panel/images/admin-placeholder.png') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="javascript:void(0)" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                     @if(auth()->user()->hasRole('Admin'))
                     <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @endif
               @can('mange user')
               <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Manage Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('permission.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('role.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                    </ul>
                </li>
               @endcan
                <!--Customers-->
                @can('manage customer')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Manage Customers
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('customer.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customer's</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer-group.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customer Group's</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.customerReport') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Report's</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                <!--- End Customers-->
                <!--- Stocks --->
                @can('manage products')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>
                            Manage Stocks
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('attribute.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Attributes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Special pricing</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('order.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Purchase Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reports</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                <!--- End Stock --->
                <!--- WareHouse --->
                @can('manage warehouse')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Manage WareHouse
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('warehouse.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>WareHouses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reports</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                @can('check Deliveries Record')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Check Deliveries
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('masterPicklist') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Master Picklist</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('runPicklist') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Run Picklist</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                <!-- End Distributor --->
                <!--- Driver --->
                {{-- <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-motorcycle"></i>
                        <p>
                            Manage Driver
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('driver.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Drivers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reports</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <!--Sales-->
                @can('manage sales')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-salesforce"></i>
                        <p>
                            Payment's
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sale.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Weekly Sales</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sale.customer-owing-report') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Owning Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                <!--- End sale --->
                @can('manage report')
                <li class="nav-item">
                    <a href="{{ route('customer.customer-report') }}" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            Customer Report
                        </p>
                    </a>
                </li>
                @endcan
                @if(auth()->user()->hasRole('Driver'))
                    @can('runpicklist')
                    <li class="nav-item">
                        <a href="{{ route('driverPicklist.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-clock"></i>
                            <p>
                                Run Picklist
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('casualOrders') }}" class="nav-link">
                            <i class="nav-icon fas fa-clock"></i>
                            <p>
                                Casual Orders
                            </p>
                        </a>
                    </li>
                    @endcan
                @endif
                @can('manage setting')
                <li class="nav-item">
                    <a href="{{ route('scriptSetting') }}" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                           Setting
                        </p>
                    </a>
                </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
