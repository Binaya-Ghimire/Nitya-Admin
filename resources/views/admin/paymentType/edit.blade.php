@extends('layouts.backend')
@section('admin-content')
<div class="content-wrapper">
    <div class="box box-primary">
        @include('flashMsg.flashmessages')
        <div class="box-header">
            <h3>Edit Payment Type</h3>
        </div>
        <div class="box-body">
          <form class="form-horizontal" method="post" action="{{route('update-payment-type', $paymentType)}}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="col-md-4 control-label">Payment Type:</label>
                <div class="col-md-6">
                    <input  class="form-control" type="text" name="name" value="{{$paymentType->name}}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Status:</label>
                <div class="col-md-6">
                    <input  class="form-control" type="number" name="status" value="{{$paymentType->status}}" required>
                </div>
            </div>            
            <div class="col-md-offset-4">
                <button class="btn btn-primary">Update Payment Type</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection