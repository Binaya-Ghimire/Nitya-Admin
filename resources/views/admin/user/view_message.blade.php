@extends('layouts.backend')
@section('admin-content')
<div class="content-wrapper">
    <div class="col-md-12 main">
        <div class="box box-primary">
            @include('flashMsg.flashmessages')
            <div class="box-header">
                <h3>
                    Message Details
                </h3>
            </div>
            <div class="box-body" >

            <ul class="list-group col-md-6">
                <li class="list-group-item">
                    <strong>Sent By</strong> : {{ $smshistory->user->name }}
                </li>
                <li class="list-group-item">
                    <strong>Sent To</strong> : {{ $smshistory->send_to }}
                </li>
                <li class="list-group-item">
                    <strong>Coin Used</strong> :{{$smshistory->coins_used}} 
                </li>
                <li class="list-group-item">
                    <strong>Status</strong> :{{ $smshistory->status }} 
                </li>               

                <li class="list-group-item">
                    <strong>Sms Sent Date</strong> : {{ $smshistory->created_at->format("F j, Y, g:i a") }}
                </li>
            </ul>
            <ul class="list-group col-md-6">
                <li class="list-group-item">
                    <strong>Message content</strong> 
                </li>
                <li class="list-group-item">
                    {{ $smshistory->message }}
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
@endsection