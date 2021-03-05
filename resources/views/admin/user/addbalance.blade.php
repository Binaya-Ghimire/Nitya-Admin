@extends('layouts.backend')
@section('admin-content')
<div class="content-wrapper">
    <div class="box box-primary">
        @include('flashMsg.flashmessages')
        <div class="box-header">
            <h3>Add Balance To User</h3>
        </div>
        <div class="box-body">
          <form class="form-horizontal" method="post" action="{{route('save-user-balance', $user)}}">
                    @method('PUT')
                    {{csrf_field()}} 

                    <div class="form-group">
                        <label class="col-md-4 control-label">Amount:</label>
                        <div class="col-md-6">
                           <input  class="form-control" type="number" name="amount" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Rate:</label>
                        <div class="col-md-6">
                           <input  class="form-control" type="number" value="{{$default_rate->default_rate}}" name="rate" step="any">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Remarks:</label>
                        <div class="col-md-6">
                           <textarea class="form-control" type="text" name="remarks" ></textarea>  
                        </div>
                    </div>

                    <div class="col-md-offset-4">
                        <button class="btn btn-primary">Add Balance</button>
                    </div>
          </form>

      </div>
  </div>
</div>
@endsection