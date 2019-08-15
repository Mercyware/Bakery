<form action="{{route('supply.store')}}" method="POST" class="remove-record-model">
    @csrf
    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">New Delivery : {{$supplier->name}}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="supplier_id" value="{{$supplier->id}}">
                    <div class="col-md-12">
                        <div class="callout callout-info"><i class="fa fa-info-circle"></i> Please note that you
                            should
                            only record orders that are received
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="description">Product Description</label>
                            <input type="text" class="form-control " id="description" name="description"
                                   placeholder="Enter Product Information" required value="">

                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="date_delivered">Date Delivered</label>
                            <input type="date" class="form-control " id="date_delivered" name="date_delivered"
                                   placeholder="Enter Date Delivered" required value="">

                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control " id="amount" name="amount"
                                   placeholder="Enter Amount" required value="">

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="more_details">More Details (Optional)</label>
                            <textarea class="form-control " id="more_details" name="more_details"
                                      placeholder="Provide more details about the supplies"></textarea>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                            data-dismiss="modal">Close
                    </button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
