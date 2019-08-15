@extends('layouts.admin_layout')
@section('title') Update Supplier Record @endsection
@section('description') Edit  {{$supplier->name}} @endsection
@section('content')

    <form action="{{route('supplier.update',$supplier->id)}}" method="POST">
        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <div class="col-md-12">
            <div class="form-group ">
                <label for="name">Supplier Name</label>
                <input type="text" class="form-control " id="name" name="name"
                       placeholder="Enter Supplier name" required value="{{$supplier->name}}">

            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group ">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control " id="phone" name="phone"
                       placeholder="Enter Supplier Phone Number" required value="{{$supplier->phone}}">

            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group ">
                <label for="email">Email </label>
                <input type="email" class="form-control " id="email" name="email"
                       placeholder="Enter Supplier Email Address" required value="{{$supplier->email}}">

            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group ">
                <label for="description">Supplier Description</label>
                <textarea class="form-control " id="description" name="description"
                          placeholder="Enter Supplier Description" required>{{$supplier->description}}</textarea>

            </div>
        </div>


        <div class="col-md-12">
            <hr/>
            <h2 class="text-center">Supplier Bank Information</h2>
            <hr/>
        </div>


        <div class="col-md-6">
            <div class="form-group ">
                <label for="bank_id">Bank </label>
                <select class="form-control " id="bank_id" name="bank_id">

                    @foreach($banks as $bank)
                        <option value="{{$bank->id}}" {{$bank->id==$supplier->bank_id ? 'selected="selected"':""}}>
                            {{$bank->name}}
                        </option>
                    @endforeach

                </select>


            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group ">
                <label for="account_number">Account Number </label>
                <input type="number" class="form-control " id="account_number" name="account_number"
                       placeholder="Enter Supplier Account Number" required value="{{$supplier->account_number}}">

            </div>
        </div>
        </div>
        <div class="modal-footer">
            <div class="col-md-12">
                <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                        data-dismiss="modal">Close
                </button>
                <button type="submit" class="btn btn-danger waves-effect waves-light">Submit</button>
            </div>

        </div>
        </div>
        </div>

    </form>


@endsection
@section('buttons')
    @include('partials.buttons.supplier_buttons',['supplier'=>$supplier])


@endsection


