@extends('layouts.backend')
@section('admin-content')
<div class="content-wrapper">
    <div class="col-md-12 main">
        <div class="box box-primary">
            @include('flashMsg.flashmessages')
            <div class="box-header">
                <h3>
                    User Details
                    <div class="pull-right">
                        @can('user-create')
                       <a href="{{ route('create-user') }}" class="btn btn-primary">Add User</a>
                       @endcan
                    </div>
                </h3>
            </div>
            <div class="box-body" >
                <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong> Balance Details</strong>
                    </li>
                    <li class="list-group-item">
                        <table class="table table-striped" >
                            <thead>
                                <th>Amount</th>
                                <th>Rate</th>
                                <th>Coins</th>
                            </thead>
                            <tbody>
                                @if(count($user->userBalance))
                                @foreach($user->userBalance as $balance)
                                <tr>
                                    <td>{{$balance->balance}}</td>
                                    <td>{{$balance->rate_per_sms}}</td>
                                    <td>{{$balance->coins}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><strong>
                                        Total balance :{{$user->userBalance->sum('balance')}}</strong> 
                                    </td>
                                    <td></td>
                                    <td>
                                       <strong>Total coins: {{$user->userBalance->sum('coins')}}</strong>  
                                    </td>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </li>                    
                </ul>                
            </div>
            <ul class="list-group col-md-6">
                <li class="list-group-item">
                    <strong>Name</strong> : {{ $user->name }}
                </li>
                <li class="list-group-item">
                    <strong>Email</strong> : {{ $user->email }}
                </li>
                <li class="list-group-item">
                    <strong>Role</strong> : {{$user->getRoleNames()->first()}}
                </li>                
                <li class="list-group-item">
                    <strong>Created </strong> : {{ $user->created_at->diffForHumans() }}
                </li>
                <li class="list-group-item">
                        @can('user-edit')
                        <a href="{{route('edit-user', $user)}}" class="btn btn-primary btn-sm"> Edit This User</a>
                        @endcan

                        @can('user-add-balance')
                        <a href="{{route('add-user-balance', $user)}}" class="btn btn-success btn-sm "> Add Balance To This</a>
                        @endcan

                        @can('user-balance-report')
                        <a href="{{route('user-balance-report', $user)}}" class="btn btn-sm btn-info">View Balance Report </a>
                        @endcan

                        @can('sms-history')
                        <a href="{{route('user-sms-history', $user)}}" class="btn btn-warning"> View sms History</a>
                        @endcan
                </li>
            </ul>
            <div class="title col-md-12">
                    <h4>Pyament History</h4>
                    <table class="table table-striped" id="myTable">
                    <thead>
                        <th>User</th>
                        <th>Payment Type</th>
                        <th>Amount</th>
                        <th>Rate per SMS</th>
                        <th>Coins</th>
                        <th>Added By</th>
                        <th>Date</th>
                        <th>Remarks</th>
                    </thead>
                    <tbody>
                        @foreach($user->history as $history)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>
                                @if(!is_null($history->payment_type))
                                {{$history->paymentType->name}}
                                @endif
                            </td>
                            <td>{{$history->balance}}</td>
                            <td>{{$history->rate_per_sms}}</td>
                            <td>{{$history->coins}}</td>
                            <td>{{$history->addedBy->name}}</td>
                            <td>{{$history->created_at->format('j F Y')}}</td>
                            <td>{{$history->remarks}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
             </div>
        </div>
    </div>
</div>
</div>

@endsection