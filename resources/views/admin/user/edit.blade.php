@extends('layouts.backend')
@section('admin-content')
<div class="content-wrapper">
    <div class="box box-primary">
        @include('flashMsg.flashmessages')
        <div class="box-header">
            <h3>Edit User</h3>
        </div>
        <div class="box-body">
          <form class="form-horizontal" method="post" action="{{route('update-user', $user)}}" enctype="multipart/form-data">
                    @method('put')
                    {{csrf_field()}} 

                    <div class="form-group">
                        <label class="col-md-4 control-label">User Name:</label>
                        <div class="col-md-6">
                           <input  class="form-control" type="text" name="name" value="{{$user->name}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">User Email:</label>
                        <div class="col-md-6">
                           <input  class="form-control" type="email" name="email" value="{{$user->email}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Password:</label>
                        <div class="col-md-6">
                           <input  class="form-control" type="Password" name="password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Choose a Role</label>
                        <div class="col-md-6">
                            <select name="role" class="form-control">
                                @foreach($roles as $role)
                                <option value="{{$role->name}}" {{$user->hasRole($role) == $role->id ?'selected': ''}}>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>    
                    </div>
                    <div class="col-md-offset-4">
                        <button class="btn btn-primary">Update User</button>
                    </div>
          </form>
      </div>
  </div>
</div>
@endsection