@extends('layouts.admin_layout')
@section('title') Account Balance @endsection
@section('description')  @endsection

@section('content')

    <!--   Detials Page -->
    <div class="col-md-offset-2 col-md-8" style="font-size: 20px">

        <div class="col-md-12">
            <p><strong>Balance: </strong> #{{number_format($response)}}
            </p>

        </div>


    </div>

    <!-- End of  Details Page -->





@endsection




