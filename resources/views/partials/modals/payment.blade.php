<form action="{{route('supplier.pay',$supplier->id)}}" method="POST" class="remove-record-model">
    @csrf
    <div id="payment-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">Transfer : {{$supplier->name}}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="supplier_id" value="{{$supplier->id}}">
                    <input type="hidden" name="amount_pending" value="{{$amount}}">
                    <div class="col-md-12">
                        <div class="callout callout-info"><i class="fa fa-info-circle"></i>
                            <p>Amount Owed to Supplier # {{number_format($amount)}}</p>
                            <p>
                                Please note that this
                                operation is not reversible</p>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="description">Transfer Amount</label>
                            <input type="number" class="form-control " id="amount" name="amount"
                                   placeholder="Enter Amount to Transfer to Supplier" required value="{{$amount}}"
                                   min="1" max="{{$amount}}">

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="description">Payment Description</label>
                            <input type="text" class="form-control " id="description" name="description"
                                   placeholder="Enter Payment Description" required value="">

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
    </div>
</form>
