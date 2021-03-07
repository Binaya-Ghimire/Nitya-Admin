@extends('layouts.backend')
@section('admin-content')
<div class="content-wrapper">
    <div class="box box-primary">
        @include('flashMsg.flashmessages')
        <div class="box-header">
            <h3>Send SMS</h3>
        </div>
        <div class="box-body">
          <form class="form-horizontal" method="post" action="{{route('send.sms')}}">
            @csrf

            <div class="form-group">
                <label class="col-md-4 control-label">Enter number:</label>
                <div class="col-md-6">
                    <input  class="form-control" type="text" name="number" placeholder="enter number" value="{{old('number')}}" pattern="[9]{1}[8]{1}[0-9]{8}" required>
                </div>
            </div> 

            <div class="form-group">
                <label class="col-md-4 control-label">Message:</label>
                <div class="col-md-6">
                    <textarea class="form-control" type="text" name="message" placeholder="Payment type" value="{{old('message')}}" required></textarea> 
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Select token:</label>
                <div class="col-md-6">
                    <select class="form-control" name="token">
                        @foreach($tokens as $token)
                        <option value="{{$token->token}}">{{$token->token}}</option>
                        @endforeach
                    </select>
                </div>
            </div>           
            <div class="col-md-offset-4">
                <button class="btn btn-primary">Send SMS</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection