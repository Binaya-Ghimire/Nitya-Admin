@extends('layouts.backend')
@section('admin-content')
<div class="content-wrapper">
    <div class="col-md-12 main">
        <div class="box box-primary">
            @include('flashMsg.flashmessages')
            <div class="box-header">
                <h3>
                    Payment Details
                </h3>
            </div>
            <div class="box-body" >

            <ul class="list-group col-md-6">
                <li class="list-group-item">
                    <strong>Payment By</strong> : {{ $payment->user->name }}
                </li>
                <li class="list-group-item">
                    <strong>Email</strong> : {{ $payment->user->email }}
                </li>
                <li class="list-group-item">
                    <strong>Amount</strong> :{{$payment->amount}} 
                </li>
                <li class="list-group-item">
                    <strong>Payment Type</strong> :{{$payment->paymentType->name}} 
                </li>
                <li class="list-group-item">
                    <strong>Status</strong> :{{$payment->paymentstatus->status}} 
                </li>                
                <li class="list-group-item">
                    <strong>Payment Date</strong> : {{ $payment->date}}
                </li>
                <li class="list-group-item">
                    <strong>Payment Date</strong> : {{ $payment->created_at->format('l j F Y') }}
                </li>

                <li class="list-group-item">
                    <strong>Transaction Id</strong> : {{ $payment->transaction_id }}
                </li>
                <li class="list-group-item">
                    <strong>remarks</strong> : {{ $payment->remark }}
                </li>
                @if(!is_null($payment->verified_by))
                <li class="list-group-item">
                    <strong>verified by</strong> : {{ $payment->verifiedBy->name }}
                </li>
                @endif

            </ul>
            
            <div class="col-md-6">
                <form class="form-horizontal" method="post" action="{{route('update-payment', $payment)}}">
                @method('PUT')
                @csrf
                    <div class="form-group">
                        <label class="col-md-4 control-label">Change Status:</label>
                        <div class="col-md-6">
                            <select class="form-control" name="status">
                                @foreach($statuses as $status)
                                <option value="{{$status->id}}">{{$status->status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Rate Per SMS:</label>
                        <div class="col-md-6">
                            <input type="number" name="rate" class="form-control" step="any" value="{{$rate->default_rate}}"> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Remarks:</label>
                        <div class="col-md-6">
                            <textarea class="form-control" type="text" name="remarks" placeholder="Remarks "></textarea>
                        </div>
                    </div>            
                    <div class="col-md-offset-4">
                        <button class="btn btn-primary">Updates Payment Status</button>
                    </div>
                </form> 
            </div>
            
        </div>
    </div>
</div>
</div>
@endsection