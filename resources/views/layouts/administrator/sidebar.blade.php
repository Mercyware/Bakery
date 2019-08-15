<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>


            <li class="active">
                <a href="{{route('suppliers')}}">
                    <i class="fa fa-user"></i> <span>Suppliers</span>

                </a>

            </li>

            <li class="active">
                <a href="{{route('supplies')}}">
                    <i class="fa fa-cart-plus"></i> <span>Supplies</span>

                </a>

            </li>

            <li class="active">
                <a href="{{route('suppliers.payment')}}">
                    <i class="fa fa-money"></i> <span>Payment</span>

                </a>

            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i> <span>Settings</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{route('account.balance')}}"><i class="fa fa-circle-o"></i> Account Balance </a>
                    </li>


                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
