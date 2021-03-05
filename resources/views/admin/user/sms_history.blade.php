@extends('layouts.backend')
@section('admin-content')
    <div class="content-wrapper">
        <div class="box box-primary">
            @include('flashMsg.flashmessages')
            <div class="box-header">
                <h3>
                    SMS Report of {{$user->name}}
                </h3>
            </div>
            <div class="box-body table-responsive">
                    <h4>SMS History</h4>
                    <table class="table table-striped" id="myTable">
                    <thead>
                        <th>S.no</th>
                        <th>Send By</th>
                        <th>Send To</th>
                        <th>Coins Used</th>
                        <th>Status</th>
                        <th>sent date</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($user->SmsHistory as $history)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$history->send_to}}</td>
                            <td>{{$history->coins_used}}</td>
                            <td>{{$history->status}}</td>
                            <td>{{$history->created_at->format("F j, Y, g:i a")}}</td>
                            <td>
                                <a href="{{route('view_details',$history)}}" class="btn btn-info bt-sm">View message</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
@endsection