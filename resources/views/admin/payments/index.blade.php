@extends('layouts.backend')
@section('admin-content')
    <div class="content-wrapper">
        <div class="box box-primary">
            @include('flashMsg.flashmessages')
            <div class="box-header">
                <h3>
                    Payment Lists
                </h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <th>S.No</th>
                        <th>Payment By</th>
                        <th>Payment Type</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Created Time</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$payment->user->name}}</td>
                                <td>{{$payment->paymentType->name}}</td>
                                <td>{{$payment->amount}}</td>
                                <td>{{$payment->paymentstatus->status}}</td>
                                <td>{{$payment->created_at->format('l j F Y')}}</td>
                                <td>
                                    <a href="{{route('show-payment', $payment)}}" class="btn btn-sm btn-success" >Details</a>
                                </td>
                            </tr>
                        @endforeach  
                  </tbody>
                </table>
          </div>
        </div>
    </div>
@endsection