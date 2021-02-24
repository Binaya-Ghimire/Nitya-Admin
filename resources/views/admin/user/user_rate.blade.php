@extends('layouts.backend')
@section('admin-content')
<div class="content-wrapper">
    <div class="box box-primary">
        @include('flashMsg.flashmessages')
        <div class="box-header">
            <h3>Add User Rate Per SMS</h3>
        </div>
        <div class="box-body">
          <form class="form-horizontal" method="post" action="{{route('store-rate-per-sms', $user)}}">
                    @method('PUT')
                    {{csrf_field()}} 

                    <div class="form-group">
                        <label class="col-md-4 control-label">Rate:</label>
                        <div class="col-md-6">
                           <input  class="form-control" type="number" name="rate" step="any" placeholder="Enter rate" required>
                        </div>
                    </div>
                    <div class="col-md-offset-4">
                        <button class="btn btn-primary">Add Rate</button>
                    </div>
          </form>

      </div>
  </div>
</div>
@endsection