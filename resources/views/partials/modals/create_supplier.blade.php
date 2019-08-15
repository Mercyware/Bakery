<form action="{{route('supplier.store')}}" method="POST" class="remove-record-model">
    @csrf
    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">New Supplier </h4>
                </div>
                <div class="modal-body">

                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="name">Supplier Name</label>
                            <input type="text" class="form-control " id="name" name="name"
                                   placeholder="Enter Supplier name" required value="">

                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control " id="phone" name="phone"
                                   placeholder="Enter Supplier Phone Number" required value="">

                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="amount">Email </label>
                            <input type="text" class="form-control " id="email" name="email"
                                   placeholder="Enter Supplier Email Address" required value="">

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="description">Supplier Description</label>
                            <textarea class="form-control " id="description" name="description"
                                      placeholder="Enter Supplier Description" required></textarea>

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
                                        <option value="{{$bank->id}}">{{$bank->name}}</option>
                                    @endforeach

                            </select>


                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="account_number">Account Number </label>
                            <input type="number" class="form-control " id="account_number" name="account_number"
                                   placeholder="Enter Supplier Account Number" required value="">

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
