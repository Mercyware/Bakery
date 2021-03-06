@extends('layouts.admin_layout')
@section('title') {{$supplier->name}} @endsection
@section('description') Detailed information about {{$supplier->name}} @endsection
@section('content')

    <!--  Supplier Detials Page -->
    <div class="col-md-offset-2 col-md-8" style="font-size: 20px">
        @if($balance > 0)
            <div class="callout callout-danger"><i class="fa fa-info-circle"></i> You have pending Payment to this
                Supplier
            </div>
        @else
            <div class="callout callout-success"><i class="fa fa-info-circle"></i> You have NO pending Payment to this
                Supplier
            </div>

        @endif
        <div class="col-md-12">
            <p><strong>Name: </strong> {{$supplier->name}}
            </p>

        </div>
        <div class="col-md-12">
            <p><strong>Email: </strong> {{$supplier->email }}</p>
        </div>

        <div class="col-md-12">
            <p><strong>Phone: </strong> {{$supplier->phone }}</p>
        </div>

        <div class="col-md-12">
            <p><strong>Description: </strong> {{$supplier->description }}</p>
        </div>

        <div class="col-md-12">
            <p><strong>Date Registered: </strong> {{$supplier->created_at->format('l jS \\of F Y ') }}</p>
        </div>

        <div class="col-md-12">
            <hr/>
            <h2 class="text-center">Supplier Supplies Details</h2>
            <hr/>
        </div>

        <div class="col-md-12">
            <p><strong>Pending Payment
                    : </strong> # {{  number_format($balance)}}
            </p>
        </div>

    </div>

    <!-- End of Supplier Details Page -->


    <!-- Popup Forms -->

    <!-- New Supply Popup Form -->
    @include('partials.modals.supply',['supplier'=>$supplier])
    @include('partials.modals.payment',['supplier'=>$supplier, 'amount'=>$balance])


@endsection
@section('buttons')

    @include('partials.buttons.supplier_buttons',['supplier'=>$supplier])

    <a class="btn btn-primary waves-effect waves-light remove-record  btn-md "
       data-toggle="modal"
       data-url="{{route('supply.store')}}"
       data-id="{{$supplier->id}}" data-target="#custom-width-modal"> New Supply</a>




    @if($balance > 0)
        <a class="btn btn-primary waves-effect waves-light remove-record  btn-md "
           data-toggle="modal"
           data-url="{{route('supply.store')}}"
           data-id="{{$supplier->id}}" data-target="#payment-modal"> Make Payment</a>
    @endif



@endsection


