@extends('layouts.backend')
@section('admin-content')
<div class="content-wrapper">
    <div class="box box-primary">
        @include('flashMsg.flashmessages')
        <div class="box-header">
            <h3>Edit Default Rate</h3>
        </div>
        <div class="box-body">
          <form class="form-horizontal" method="post" action="{{route('update-default-rate', $rate->id)}}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="col-md-4 control-label">Add Default Rate:</label>
                <div class="col-md-6">
                    <input  class="form-control" type="number" step="0.01" name="default_rate" value="{{$rate->default_rate}}" required>
                </div>
            </div>            
            <div class="col-md-offset-4">
                <button class="btn btn-primary">Add Default Rate</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection