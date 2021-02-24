@extends('layouts.backend')
@section('admin-content')
    <div class="content-wrapper">
        <div class="box box-primary">
            @include('flashMsg.flashmessages')
            <div class="box-header">
                <h3>
                    Users
                </h3>

                <div class="pull-right"> 
                    <a href="{{url('admin/user/create')}}" class="btn btn-primary">Add User</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created Time</th>
                        <th>Login</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                            <label class="badge badge-success">{{ $v }}</label>
                                         @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if (is_null($user->banned_at))
                                       <span class="badge badge-success">Active</span>
                                       <a href="{{route('ban-user', $user)}}" class="btn btn-danger btn-xs">Ban user</a>
                                    @else
                                        <span class="badge badge-danger">Blocked</span>
                                        <a href="{{route('unban-user', $user)}}" class="btn btn-success btn-xs">Unban user</a>
                                    @endif
                                </td>
                                <td>{{$user->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('clientLogin', $user)}}" target="_blank" class="btn btn-info btn-xs">Login</a>
                                </td>
                                <td>
                                    <a href="{{route('edit-user', $user)}}" class="btn btn-sm btn-primary" >Edit</a>
                                        
                                    <a href="{{route('show-user', $user)}}" class="btn btn-success btn-sm">Show</a>
                                </td>
                            </tr>
                        @endforeach  
                  </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection