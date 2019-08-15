@extends('layouts.admin_layout')
@section('content')

    <div class="content-wrapper">

        <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="text-left">
                {{$user->fullName}} Account
                <small>Control panel</small>
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

                        </div>
                        <div class="box-body">
                            <hr/>


                            <div class="col-md-offset-2 col-md-8" style="font-size: 20px">

                                <div class="col-md-12">
                                    <p><strong>Name: </strong> {{$user->fullName}}
                                    </p>

                                </div>
                                <div class="col-md-12">
                                    <p><strong>Email: </strong> {{$user->email }}</p>
                                </div>

                                <div class="col-md-12">
                                    <p><strong>Phone: </strong> {{$user->mobile }}</p>
                                </div>
                                {{--<div class="col-md-12">--}}
                                {{--<p>--}}
                                {{--<strong>User Type: </strong> @if($user->usertype == 1 ) Level 1--}}
                                {{--User @else Level 2 User @endif--}}
                                {{--</p>--}}
                                {{--</div>--}}

                                <div class="col-md-12">
                                    <p>
                                        <strong>User Account Status: </strong>
                                        @if($user->is_active)
                                            <label class="label label-success"> Account is Active</label>
                                        @else
                                            <label class="label label-danger"> Account is Blocked</label>
                                        @endif

                                    </p>
                                </div>

                                <div class="col-md-12">
                                    <p>
                                        <strong>Agents Assigned : </strong> {{$user->agents->count()}}
                                    </p>
                                </div>


                            </div>

                            <div class="col-md-12">
                                <form method="post" action="{{route('admin.staffs.blockStaff')}}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$user->id}}">

                                    <input type="hidden" name="type" value=" @if(!$user->is_active) 1 @else 0 @endif">
                                    <button type="submit" class="btn   @if($user->is_active)    btn-warning
@else
                                        btn-success
@endif
                                        waves-effect waves-light remove-record  btn-md pull-left">

                                        @if($user->is_active)
                                            <span
                                                class="fa fa-lock"></span>    Block User
                                        @else
                                            <span
                                                class="fa fa-unlock"></span>    Activate User
                                        @endif

                                    </button>

                                </form>


                                <a class="btn btn-danger waves-effect waves-light remove-record  btn-md pull-right"
                                   data-toggle="modal"
                                   data-url="{!! URL::route('admin.staffs.editStaff', $user->id) !!}"
                                   data-id="{{$user->id}}" data-target="#custom-width-modal"><span
                                        class="fa fa-edit"></span> Edit Staff Information</a>

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

    <form action="{{route('admin.staffs.editStaff', $user->id)}}" method="POST" class="remove-record-model">
        @csrf
        <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" style="width:55%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="custom-width-modalLabel">{{$user->fullName}}</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="user_id" value="{{$user->id}}">

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control " id="first_name" name="first_name"
                                       placeholder="Enter first name" required value="{{$user->first_name}}">
                                {{--<small id="stateHelp" class="form-text text-muted">Please provide valid state name--}}
                                {{--</small>--}}
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control " id="last_name" name="last_name"
                                       placeholder="Enter last name" required value="{{$user->last_name}}">
                                {{--<small id="stateHelp" class="form-text text-muted">Please provide valid state name--}}
                                {{--</small>--}}
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="last_name">Email</label>
                                <input type="text" class="form-control " id="email" name="email"
                                       placeholder="Enter Email" required value="{{$user->email}}">
                                {{--<small id="stateHelp" class="form-text text-muted">Please provide valid state name--}}
                                {{--</small>--}}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="last_name">Mobile Number</label>
                                <input type="text" class="form-control " id="mobile" name="mobile"
                                       placeholder="Enter Mobile Number" required value="{{$user->mobile}}">
                                {{--<small id="stateHelp" class="form-text text-muted">Please provide valid state name--}}
                                {{--</small>--}}
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                                data-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Update Staff</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection



