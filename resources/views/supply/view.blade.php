@extends('layouts.admin_layout')
@section('title') Supply Details @endsection
@section('description') Product supplied by {{$supply->Supplier->name}} @endsection

@section('content')

    <!--  Supplier Detials Page -->
    <div class="col-md-offset-2 col-md-8" style="font-size: 20px">

        <div class="col-md-12">
            <p><strong>Description: </strong> {{$supply->description}}
            </p>

        </div>
        <div class="col-md-12">
            <p><strong>Supplier Name: </strong> {{$supply->Supplier->name }}</p>
        </div>

        <div class="col-md-12">
            <p><strong>Amount: </strong># {{number_format($supply->amount) }}</p>
        </div>


        <div class="col-md-12">
            <p><strong>Date Delivered: </strong> {{$supply->date_delivered->format('l jS \\of F Y ') }}</p>
        </div>


    </div>

    <!-- End of Supplier Details Page -->


    <!-- Popup Forms -->

    <!-- New Supply Popup Form -->
    @include('partials.modals.supply',['supplier'=>$supply->Supplier])



@endsection

@section('buttons')
    @include('partials.buttons.supplier_buttons',['supplier'=>$supply->Supplier])

    <a class="btn btn-primary waves-effect waves-light remove-record  btn-md "
       data-toggle="modal"
       data-url="{{route('supply.store')}}"
       data-id="{{$supply->id}}" data-target="#custom-width-modal"> New Supply</a>



@endsection


