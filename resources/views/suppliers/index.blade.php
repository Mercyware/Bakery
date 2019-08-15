@extends('layouts.admin_layout')
@section('title') All Suppliers @endsection
@section('description') The list of all your suppliers @endsection

@section('content')

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

        <button type="submit" value="submit">Submit</button>
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






