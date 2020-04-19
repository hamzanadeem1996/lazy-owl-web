@extends('includes.user.base')
@section('content')
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6">
                        <h1>Payment Methods</h1>
                    </div>
                </div>
                <div class="separator mb-5"></div>
            </div>
            
            <div class="col-lg-12">
                <div class="row mb-4">
                    @foreach ($payments as $payment)
                        <div class="col-md-6 col-sm-6 col-lg-4 col-12 mb-4">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img alt="Profile" src="/payment/{{$payment->image}}" class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail">
                                        <p class="list-item-heading mb-1">{{$payment->title}}</p>
                                        {{-- @if(Auth::user()->role == 2) --}}
                                            <p class="mb-2 text-muted text-small">{{$payment->owner}}</p>
                                            <h3>{{$payment->acc_number}}</h3>
                                        {{-- @endif --}}
                                        @if(Auth::user()->role == 3)
                                            @if($payment->id == 4)
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#addBankDetailsModal">Add Details</button>
                                            @else
                                                <button type="button" onclick="setMethodId({{$payment->id}})" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#addDetailsModal">Add Details</button>
                                            @endif
                                        @else
                                            @if($payment->id == 4)
                                                <button type="button" onclick="setMethodId({{$payment->id}})" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#creditCardModal">Add Amount</button>
                                            @endif
                                        @endif

                                        @if(Auth::user()->role == 4)
                                            @if($payment->id == 4)
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#addBankDetailsModal">Add Details</button>
                                            @else
                                                <button type="button" onclick="setMethodId({{$payment->id}})" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#addDetailsModal">Add Details</button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="creditCardModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalContentLabel">Add Amount to Wallet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <div class="links">
                        <form action="/user/payment" method="POST">
                            @csrf
                            <script
                                src="{{env('STRIPE_SOURCE')}}" class="stripe-button"
                                data-key="{{env('STRIPE_PUBLIC_KEY')}}"
                                data-amount="{{env('STRIPE_ONE_TIME_PAYMENT')}}"
                                data-name="Lazy Owl"
                                data-description="Lazy Owl Wallet Deposit"
                                data-image="{{env('STRIPE_IMAGE')}}"
                                data-locale="auto"
                                data-currency="{{env('STRIPE_CURRENCY')}}"
                            ></script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addBankDetailsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalContentLabel">Add Account Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form action="/user/payment-method/details/add" method="POST" id="bank-acc-form">
                    @csrf
                    <div class="form-group">
                        <label for="acc_title">Account Title *</label>
                        <input class="form-control" type="text" name="acc_title" id="acc-title">
                        <small style="color: red" id="acc-title-error"></small>
                    </div>
                    <div class="form-group">
                        <label for="acc_number">Account Number *</label>
                        <input class="form-control" type="number" name="acc_number" id="acc-number">
                        <small style="color: red" id="acc-number-error"></small>
                    </div>
                    <div class="form-group">
                        <label for="bank_name">Bank Name *</label>
                        <input class="form-control" type="text" name="bank_name" id="bank-name">
                        <small style="color: red" id="bank-name-error"></small>
                    </div>
                    <div class="form-group">
                        <label for="branch_code">Branch Code *</label>
                        <input class="form-control" type="number" name="branch_code" id="branch-code">
                        <small style="color: red" id="branch-code-error"></small>
                    </div>
                    <p style="color: red" id="error"></p>
                    <input type="hidden" name="payment_method_id" value="4">
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="submitForm('bank-acc-form')" class="btn btn-primary">Add</button>
                </div>
                    
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addDetailsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalContentLabel">Add Account Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form action="/user/payment-method/details/add" method="POST" id="simple-acc-form">
                    @csrf
                    <div class="form-group">
                        <label for="acc_title">Account Number *</label>
                        <input class="form-control" type="text" name="acc_number" id="acc-number">
                    </div>
                    <input type="hidden" name="payment_method_id" id="payment-method-id">
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="submitForm('simple-acc-form')" class="btn btn-primary">Add</button>
                </div>
                    
            </div>
        </div>
    </div>
</div>

<script>
    function submitForm(id){
        let valid = false;
        if (id === 'bank-acc-form'){
            if(bankAccValidations()){
                valid = true;
            }
        }
        if (valid){
            $(`#${id}`).submit();
        }
    }

    function bankAccValidations(){
        let valid = true;
        let accTitle = $('#acc-title').val(); 
        let accNumber = $('#acc-number').val(); 
        let bankName = $('#bank-name').val(); 
        let branchCode = $('#branch-code').val(); 
        
        if ((accTitle == null || accTitle == '') || 
            (accNumber == null || accNumber == '') || 
            (bankName == null || bankName == '') || 
            (branchCode == null || branchCode == '')){
            
            $('#error').html('Please fill out all the required fields and enter valid data');
            valid = false;
            
        }
        
        return valid;
    }

    function setMethodId(id) {
        $('#payment-method-id').val(id);
    }
</script>
@stop