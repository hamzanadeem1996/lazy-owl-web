@extends('includes.admin.base')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Payment Methods</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Active Payment Methods</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @foreach ($payments as $payment)
                        <div class="col-md-3 col-xs-12 widget widget_tally_box">
                            <div class="x_panel ui-ribbon-container fixed_height_390">
                                <div class="x_title">
                                <h2>{{ $payment->title }}</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
    
                                <div style="text-align: center; margin-bottom: 17px">
                                <img src="/payment/{{$payment->image}}" alt="payment-logo" height="120" width="150" style="border-radius: 10%">
                                </div>
    
                                <h3 class="name_title">{{ $payment->acc_number }}</h3>
                                <p>Active</p>
    
                                <div class="divider"></div>
                                <p>{{ $payment->owner }}</p>
                                <div style="text-align:center">
                                    <button onclick="assignPaymentMethodId({{$payment->id}})" class="btn btn-success" data-toggle="modal" data-target="#disableModal" style="margin-top: 5%,">Edit</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="disableModal" tabindex="-1" role="dialog" aria-labelledby="disableModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Payment Method
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="disable-form" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="/admin/payment-methods/edit">
                            <input type="hidden" name="id" id="payment-method-id">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Account Number <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="account-number" style="border-radius: 1rem !important;" name="acc_number"  class="form-control col-md-7 col-xs-12"  required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Owner Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="owner-name" style="border-radius: 1rem !important;" name="owner"  class="form-control col-md-7 col-xs-12"  required>
                                </div>
                            </div>
                            <div id="error-div" style="display: none">
                                <p style="color: red">*Please enter required vallues</p>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            
                            <button type="button" onclick="submitUpdateForm()" class="btn btn-success" id="submitButton">Update</button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script>
        function submitUpdateForm() {
            let account = $('#account-number').val();
            let owner = $('#owner-name').val();
            if (account && owner){
                $('#disable-form').submit();
            }else{
                $('#error-div').css('display', 'block')
            }
        }
        function assignPaymentMethodId(id) {
            $('#payment-method-id').val(id);
        }

    </script>

@stop
