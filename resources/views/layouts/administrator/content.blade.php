<div class="content-wrapper">

    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="text-left">
            @yield('title')
            <br/>
            <small>@yield('description')</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">

                <!-- Chat box -->
                @include('partials.flash')
                @include('partials.errors')
                <div class="box box-primary">

                    <div class="box-header">
                        @yield('buttons')
                    </div>
                    <div class="box-body">
                        <hr/>

                        @yield('content')

                    </div>
                    <!-- /.chat -->
                </div>
                <!-- /.box (chat box) -->


            </section>

        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
</div>
