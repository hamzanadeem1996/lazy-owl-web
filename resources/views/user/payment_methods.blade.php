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
                                        @if(Auth::user()->role == 2)
                                            <p class="mb-2 text-muted text-small">{{$payment->owner}}</p>
                                            <h3>{{$payment->acc_number}}</h3>
                                        @endif
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#creditCardModal">Add amount</button>
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


@stop