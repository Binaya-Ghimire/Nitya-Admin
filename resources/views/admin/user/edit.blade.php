@extends('layouts.backend')
@section('admin-content')
<div class="content-wrapper">
   <div class="box box-primary">
      @include('flashMsg.flashmessages')
      <div class="box-header">
         <h3>Edit User</h3>
      </div>
      <div class="box-body col-md-6">
         <form class="form-horizontal" method="post" action="{{route('update-user', $user)}}">
            @method('put')
            @csrf 
            <div class="form-group">
               <label class="col-md-4 control-label">User Name:</label>
               <div class="col-md-8">
                  <input  class="form-control" type="text" name="name" value="{{$user->name}}" required>
               </div>
            </div>
            <div class="form-group">
               <label class="col-md-4 control-label">User Email:</label>
               <div class="col-md-8">
                  <input  class="form-control" type="email" name="email" value="{{$user->email}}" required>
               </div>
            </div>
            <div class="form-group">
               <label class="col-md-4 control-label">User Mobile:</label>
               <div class="col-md-8">
                  <input  class="form-control" type="text" name="mobile" value="{{$user->mobile}}" pattern="[98]{2}[0-9]{8}" required>
               </div>
            </div>
            <div class="form-group">
               <label class="col-md-4 control-label">Choose a Role</label>
               <div class="col-md-8">
                  <select name="role" class="form-control">
                  @foreach($roles as $role)
                  <option value="{{$role->name}}" {{$user->hasRole($role) == $role->id ?'selected': ''}}>{{$role->name}}</option>
                  @endforeach
                  </select>
               </div>
            </div>
            <div class="col-md-offset-4">
               <button class="btn btn-primary">Update User Details</button>
            </div>
         </form>
      </div>
      <div class="box-body col-md-6">
         <form class="form-horizontal" method="post" action="{{route('update-password', $user)}}">
            @method('PUT')
            @csrf
            <div class="form-group">
               <label class="col-md-4 control-label">Password:</label>
               <div class="col-md-8">
                  <input  class="form-control" type="Password" name="password" required>
               </div>
            </div>
            <div class="form-group">
               <label class="col-md-4 control-label">Confirm Password:</label>
               <div class="col-md-8">
                  <input  class="form-control" type="Password" name="password_confirmation">
               </div>
            </div>
            <div class="col-md-offset-4">
               <button class="btn btn-primary">Update Password</button>
            </div>
         </form>
      </div>
      <hr>
   </div>
</div>
@endsection