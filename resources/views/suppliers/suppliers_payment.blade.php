@extends('layouts.admin_layout')
@section('title') All Suppliers @endsection
@section('description') The list of all your suppliers @endsection

@section('content')
    <div class="alert alert-info">
        <p><strong>NB : </strong> Payment beyond the amount owed will be ignored</p>
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

                        <td><input type="hidden" name="selected_suppliers[]" value="{{$supplier->id}}">S/N</td>
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

        <button type="submit" value="submit">Submit</button>
        <!-- End of Suppliers List -->
    </form>




@endsection





@section('script')

@endsection






