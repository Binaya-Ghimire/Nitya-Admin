@extends('layouts.backend')
@section('admin-content')
<div class="content-wrapper">
    <div class="box box-primary">
        @include('flashMsg.flashmessages')
        <div class="box-header">
            <h3>Add a Role</h3>
        </div>
        <div class="box-body">
          <form class="form-horizontal" method="post" action="{{route('store-role')}}">
            @csrf
            <div class="form-group">
                <label class="col-md-4 control-label">Role Name:</label>
                <div class="col-md-6">
                    <input  class="form-control" type="text" name="name" placeholder="role name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label"> Select Permissions</label>
                <div class="col-md-6">
                    @foreach($permissions as $permission)
                    <div class="col-md-6">
                         <input type="checkbox" id="permission" name="permissions[]" value="{{$permission->id}}"> <label class="control-label">{{$permission->name}}</label>
                    </div>
                    @endforeach
                    
                </div>
            </div>
            
            <div class="col-md-offset-4">
                <button class="btn btn-primary">Add Role</button>
            </div>
        </form>

    </div>
  </div>
</div>
@endsection