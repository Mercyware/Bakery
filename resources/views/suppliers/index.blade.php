@extends('layouts.admin_layout')
@section('title') All Suppliers @endsection
@section('description') The list of all your suppliers @endsection

@section('content')
    <div class="callout callout-info"><i class="fa fa-info-circle"></i> For Bulk Transfer, Select suppliers and click on
        the Make Bulk Payment Button
    </div>
    <form action="{{route('supplier.pay.multiple')}}" method="POST">
    @csrf
    <!-- Suppliers List -->
        <table class="table table-bordered" id="suppliers">
            <thead>
            <tr>
                <th>S/N</th>
                <th> Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Pending Payment</th>
                <th></th>
            </tr>
            </thead>

        </table>
        <div class="col-12" style="padding-top: 20px">
            <button type="submit" value="submit" class="btn btn-primary pull-right ">Continue to Make Bulk Payment
            </button>
        </div>

        <!-- End of Suppliers List -->
    </form>


@endsection

@section('buttons')
    <a class="btn btn-primary waves-effect waves-light remove-record  btn-md "
       data-toggle="modal"
       data-url="{{route('supply.store')}}"
       data-id="0" data-target="#custom-width-modal"> New Supplier</a>

@endsection


@include('partials.modals.create_supplier')



@section('script')
    @include('partials.scripts.datatable')
    <script>
        $(function () {
            var oTable = $('#suppliers').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route("suppliers.list")}}'

                },
                columns: [
                    {data: 'check', name: 'check'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'amount', name: 'amount'},
                    {data: 'action', name: 'action'},

                ],
            });


        });
    </script>

@endsection






