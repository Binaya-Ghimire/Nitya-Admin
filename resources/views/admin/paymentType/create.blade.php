@extends('layouts.backend')
@section('admin-content')
<div class="content-wrapper">
    <div class="box box-primary">
        @include('flashMsg.flashmessages')
        <div class="box-header">
            <h3>Add Payment Type</h3>
        </div>
        <div class="box-body">
          <form class="form-horizontal" method="post" action="{{route('store-payment-type')}}">
            @csrf
            <div class="form-group">
                <label class="col-md-4 control-label">Payment Type:</label>
                <div class="col-md-6">
                    <input  class="form-control" type="text" name="name" placeholder="Payment type" required>
                </div>
            </div>           
            <div class="col-md-offset-4">
                <button class="btn btn-primary">Add Payment Type</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection