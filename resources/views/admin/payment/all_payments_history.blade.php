@extends('includes.admin.base')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Payments History</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>History</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Amount</th>
                                <th>Email Used</th>
                                <th>Receipt</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$payment->user->name}}</td>
                                    <td>${{$payment->amount}}</td>
                                    <td>{{$payment->email}}</td>
                                    <td><a href="{{$payment->receipt_url}}" target="_blank"> Receipt Copy </a></td>
                                    <td>{{$payment->created_at}}</td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
