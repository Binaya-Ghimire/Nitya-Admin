@extends('layouts.backend')
@section('admin-content')
    <div class="content-wrapper">
        <div class="box box-primary">
            @include('flashMsg.flashmessages')
            <div class="box-header">
                <h3>
                    Roles
                </h3>

                <div class="pull-right"> 
                    <a href="{{route('create-role')}}" class="btn btn-primary">Add Role</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <th>S.No</th>
                        <th>Role Name</th>
                        <th>Created Time</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('edit-role', $role)}}" class="btn btn-sm btn-primary" >Edit</a>

                                    <form method="Post"  class="form-inline" action="{{route('delete-role',$role)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" onclick=" return confirm('Are You sure to delete?')" class="btn btn-danger btn-sm mb-2">Delete</button>
                                    </form>       
                                </td>
                            </tr>
                        @endforeach
                        
                  </tbody>
                  
                </table>
            </div>
        </div>
    </div>


@endsection