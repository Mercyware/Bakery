@extends('layouts.admin_layout')
@section('title') @if($supplier) {{$supplier->name}} Payment History @else All Payment History @endif @endsection
@section('description') The list of  your payment @endsection

@section('content')


    <!-- Suppliers List -->
    <table class="table table-bordered" id="supplies">
        <thead>
        <tr>
            <th>S/N</th>
            <th>Supplier</th>
            <th>Amount Paid</th>
            <th>Date Paid</th>

        </tr>
        </thead>

    </table>

    <!-- End of Suppliers List -->



@endsection
@section('buttons')
    @include('partials.buttons.supplier_buttons',['supplier'=>$supplier])


@endsection







@section('script')
    @include('partials.scripts.datatable')
    <script>
        $(function () {
            var oTable = $('#supplies').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route("suppliers.payment.list",$supplier->id??0)}}'

                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'supplier', name: 'supplier'},

                    {data: 'amount', name: 'amount'},
                    {data: 'date', name: 'date'},


                ],
            });


        });
    </script>

@endsection






