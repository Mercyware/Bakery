@extends('layouts.admin_layout')
@section('content')

    <div class="content-wrapper">

        <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="text-left">
                All Registered Staffs
                <small>Control panel</small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 ">

                    <!-- Chat box -->
                    @include('partials.flash')
                    @include('partials.errors')
                    <div class="box box-primary">

                        <div class="box-header">


                            <a class="btn btn-danger waves-effect waves-light remove-record  btn-md pull-right"
                               data-toggle="modal" data-url="{{route('admin.staffs.create')}}"
                               data-id="0" data-target="#custom-width-modal"><span
                                    class="fa fa-plus"></span> Add Staff</a>

                        </div>
                        <div class="box-body">
                            <hr/>
                            <div class="dataTable_wrapper">
                                <table class="table table-bordered" id="users-table">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Agents Assigned</th>

                                        <th></th>
                                    </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                        <!-- /.chat --></div>
                    <!-- /.box (chat box) -->


                </section>

            </div>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->
    </div>

    <form action="" method="POST" class="remove-record-model">
        <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" style="width:55%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="custom-width-modalLabel">New Staff</h4>
                    </div>
                    <div class="modal-body">

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control " id="first_name" name="first_name"
                                       placeholder="Enter first name" required>
                                {{--<small id="stateHelp" class="form-text text-muted">Please provide valid state name--}}
                                {{--</small>--}}
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control " id="last_name" name="last_name"
                                       placeholder="Enter last name" required>
                                {{--<small id="stateHelp" class="form-text text-muted">Please provide valid state name--}}
                                {{--</small>--}}
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="last_name">Email</label>
                                <input type="text" class="form-control " id="email" name="email"
                                       placeholder="Enter Email" required>
                                {{--<small id="stateHelp" class="form-text text-muted">Please provide valid state name--}}
                                {{--</small>--}}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="last_name">Mobile Number</label>
                                <input type="text" class="form-control " id="mobile" name="mobile"
                                       placeholder="Enter Mobile Number" required>
                                {{--<small id="stateHelp" class="form-text text-muted">Please provide valid state name--}}
                                {{--</small>--}}
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                                data-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Add Staff</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('script')


    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">

    {{--<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>--}}



    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>




    <script>
        $(function () {
            var oTable = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route("admin.staffs.table")}}'

                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'agent', name: 'agent'},

                    {data: 'action', name: 'action'},

                ],
            });

//            $('#search-form').on('submit', function (e) {
//                oTable.draw();
//                e.preventDefault();
//            });
        });
    </script>

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function () {
            // For A Delete Record Popup
            $('.remove-record').click(function () {


                var id = $(this).attr('data-id');
                var url = $(this).attr('data-url');
                var token = CSRF_TOKEN;
                $(".remove-record-model").attr("action", url);
                $('body').find('.remove-record-model').append('<input name="_token" type="hidden" value="' + token + '">');
                // $('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="DELETE">');
                $('body').find('.remove-record-model').append('<input name="locality_id" type="hidden" value="' + id + '">');
            });

            $('.remove-data-from-delete-form').click(function () {
                //  $('body').find('.remove-record-model').find("input").remove();
            });
            $('.modal').click(function () {
                // $('body').find('.remove-record-model').find( "input" ).remove();
            });
        });
    </script>
@endsection
