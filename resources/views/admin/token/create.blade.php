@extends('layouts.backend')
@section('admin-content')
<div class="content-wrapper">
    <div class="box box-primary">
        @include('flashMsg.flashmessages')
        <div class="box-header">
            <h3>Add User</h3>
        </div>
        <div class="box-body">
          <form class="form-horizontal" method="post" action="{{route('store-token')}}" enctype="multipart/form-data">
                    {{csrf_field()}} 

                    <div class="form-group">
                        <label class="col-md-4 control-label">Select a User</label>
                        <div class="col-md-6">
                            <select name="user_id" class="form-control">
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>    
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Status</label>
                        <div class="col-md-6">
                            <input type="radio" name="status" value="0" checked>
                            <label> InActive</label>

                            <input type="radio" name="status" value="1">
                            <label> Active</label>                       
                        </div>    
                    </div>
                    
                    <div class="col-md-offset-4">
                        <button class="btn btn-primary">Generate Token</button>
                    </div>
          </form>

      </div>
  </div>
</div>
@endsection