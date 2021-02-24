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
                    <a href="{{route('create-token')}}" class="btn btn-primary">Add Token</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>Token</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Created Time</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($tokens as $userToken)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$userToken->user->name}}</td>
                                <td>{{$userToken->token}}</td>
                                <td>
                                    @if($userToken->status ==0)
                                    <span class="badge badge-danger">InActive</span>
                                    @elseif($userToken->status==1)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-info">Marked Deleted</span>
                                    @endif
                                </td>
                                <td>{{$userToken->createdBy->name}}</td>
                                <td>{{$userToken->created_at->format('F j  Y')}}</td>           
                                <td>
                                    <a href="{{route('edit-token', $userToken)}}" class="btn btn-sm btn-primary" >Edit</a>

                                    <a href="{{route('delete-token', $userToken)}}" class="btn btn-sm btn-danger" >Delete</a>
                                </td>

                            </tr>
                        @endforeach  
                  </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection 