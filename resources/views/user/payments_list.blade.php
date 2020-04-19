@extends('includes.user.base')
@section('content')
<main>
    <div class="container-fluid disable-text-selection">
        <div class="row">
            <div class="col-12">
                <div class="mb-2">
                    <h1>Payments</h1>
                </div>
                <div class="separator mb-5"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 list" data-check-all="checkAll">
                <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
                    @if(Auth::user()->role == 2 || Auth::user()->role == 4)
                    <li class="nav-item">
                        <a class="nav-link active" onclick="showTab('first')" id="first-tab" data-toggle="tab" href="#first" role="tab"
                            aria-controls="first" aria-selected="true">Deposit</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" onclick="showTab('second')" id="second-tab" data-toggle="tab" href="#second" role="tab"
                            aria-controls="second" aria-selected="true">Wallet Transactions</a>
                    </li>
                </ul>

                <div class="card d-flex flex-row mb-3" style="background-color: #922C88;">
                    <div class="d-flex flex-grow-1 min-width-zero">
                        <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                            <a class="list-item-heading mb-1 truncate w-40 w-xs-100" style="color: white">
                                Email
                            </a>
                            
                            <p class="mb-1 w-15 w-xs-100" style="color: white">Amount</p>
                            <p class="mb-1 w-15 w-xs-100" style="color: white">Receipt</p>
                            <p class="mb-1 w-15 w-xs-100" style="color: white">Date</p>
                            
                        </div>
                    </div>
                </div>
                <div class="tab-content mb-4">
                    <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                    @if(Auth::user()->role == 2 || Auth::user()->role == 4)
                        @if (count($payments['deposit']) > 0)
                            @foreach ($payments['deposit'] as $payment)
                                <div class="card d-flex flex-row mb-3">
                                    <div class="d-flex flex-grow-1 min-width-zero">
                                        <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                            <a class="list-item-heading mb-1 truncate w-40 w-xs-100" href="#">
                                                {{$payment->user->email}}
                                            </a>
                                            <p class="mb-1 w-15 w-xs-100">${{$payment->amount}}</p>
                                            <p class="mb-1 w-15 w-xs-100"><a href="{{$payment->receipt_url}}" target="_blank">Receipt Copy</a></p>
                                            <p class="mb-1 w-15 w-xs-100">{{$payment->created_at}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card d-flex flex-row mb-3">
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                        <h1>No Data Available</h1>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    </div>
                </div>

                <div class="tab-content mb-4">
                    <div class="tab-pane show {{Auth::user()->role == 3 ? 'active': ' '}}" id="second" role="tabpanel" aria-labelledby="second-tab">
                        @if ($payments['wallet'] && count($payments['wallet']) > 0)
                            @foreach ($payments['wallet'] as $payment)
                                <div class="card d-flex flex-row mb-3">
                                    <div class="d-flex flex-grow-1 min-width-zero">
                                        <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                            <a class="list-item-heading mb-1 truncate w-40 w-xs-100" href="#">
                                                {{$payment->user->name}}
                                            </a>
                                            <p class="mb-1 w-15 w-xs-100">{{$payment->toUser->name}}</p>
                                            <p class="mb-1 w-15 w-xs-100">{{$payment->project->title}}</p>
                                            <p class="mb-1 w-15 w-xs-100">${{$payment->amount}}</p>
                                            <p class="mb-1 w-15 w-xs-100">{{$payment->created_at}}</p>
                                        
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card d-flex flex-row mb-3">
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                        <h1>No Data Available</h1>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function showTab(tabName){
        if (tabName === 'first'){
            $('#first').css('display', 'block');
            $('#second').css('display', 'none');
        }else if (tabName === 'second'){
            $('#first').css('display', 'none');
            $('#second').css('display', 'block');
        }
    }
</script>
@stop