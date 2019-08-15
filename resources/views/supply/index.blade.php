@extends('layouts.admin_layout')
@section('title') @if($supplier) {{$supplier->name}} Supplies @else All Supplies @endif @endsection
@section('description') The list of  your supplies @endsection

@section('content')


    <!-- Suppliers List -->
    <table class="table table-bordered" id="supplies">
        <thead>
        <tr>
            <th>S/N</th>
            <th>Supplier</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Date Delivered</th>
            <th></th>
        </tr>
        </thead>

    </table>

    <!-- End of Suppliers List -->



@endsection






@section('script')
    @include('partials.scripts.datatable')
    <script>
        $(function () {
            var oTable = $('#supplies').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route("supplies.list",$supplier->id??0)}}'

                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'supplier', name: 'supplier'},
                    {data: 'description', name: 'description'},
                    {data: 'amount', name: 'amount'},
                    {data: 'date_delivered', name: 'date_delivered'},
                    {data: 'action', name: 'action'},

                ],
            });


        });
    </script>

@endsection






