@extends('layouts.admin_layout')
@section('title') All Suppliers @endsection
@section('description') The list of all your suppliers @endsection

@section('content')
    <div class="callout callout-info">
        <p><strong>NB : </strong> All Suppliers have default amount you owed, you can change it if you choose</p>
    </div>
    <form action="{{route('supplier.pay.multiple.transfer')}}" method="POST">
    @csrf
    <!-- Suppliers List -->
        <table class="table table-bordered" id="suppliers">
            <thead>
            <tr>
                <th>S/N</th>
                <th> Name</th>
                <th>Pending Payment</th>
                <th>Amount</th>

            </tr>
            </thead>
            <tbody>
            @foreach($suppliers as $supplier)
                <?php
                $balance = $supplier->Supplies->sum('amount') - $supplier->Payment->sum('amount');
                ?>
                @if($balance > 0)

                    <tr>

                        <td><input type="hidden" name="selected_suppliers[]" value="{{$supplier->id}}">{{++$i}}</td>
                        <td> {{$supplier->name}}</td>
                        <td><input type="hidden" name="amount_owed[]"
                                   value="{{$balance}}">{{number_format($balance)}}
                        </td>
                        <td><input type="number" name="amount_payed[]" class="form-control" required min="1"
                                   max="{{$balance}}"
                                   value="{{$balance}}">
                        </td>

                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>

        <div class="col-12" style="padding-top: 20px">
            <button type="submit" value="submit" class="btn btn-primary pull-right ">Make Bulk Payment</button>
        </div>
        <!-- End of Suppliers List -->
    </form>




@endsection





@section('script')

@endsection






