<a class="btn btn-danger waves-effect waves-light remove-record  btn-md"
   href="{{route('suppliers')}}"> << Suppliers </a>

@if($supplier)

    <a class="btn btn-primary waves-effect waves-light remove-record  btn-md"
       href="{{route('supplies',$supplier->id)}}"> Supply History </a>

    <a class="btn btn-primary waves-effect waves-light remove-record  btn-md"
       href="{{route('suppliers.view',$supplier->id)}}">{{$supplier->name}} Profile </a>

    <a class="btn btn-primary waves-effect waves-light remove-record  btn-md"
       href="{{route('supplier.edit',$supplier->id)}}"> Update Supplier Record</a>

    <a class="btn btn-danger waves-effect waves-light remove-record  btn-md"
       href="{{route('suppliers.payment',$supplier->id)}}"> Payment History</a>
@endif
