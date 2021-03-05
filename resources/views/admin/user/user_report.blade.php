@extends('layouts.backend')
@section('admin-content')
    <div class="content-wrapper">
        <div class="box box-primary">
            @include('flashMsg.flashmessages')
            <div class="box-header">
                <h3>
                    Balance Report of {{$user->name}}
                </h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover" >
                    <thead>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>Balance</th>
                        <th>Rate</th>
                        <th>Coins</th>
                        <th>Created Time</th>
                    </thead>
                    <tbody>
                        @foreach($user->Userbalance as $balance)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$balance->user->name}}</td>
                            <td>{{$balance->balance}}</td>
                            <td>{{$balance->rate_per_sms}}</td>
                            <td>{{$balance->coins}}</td>
                            <td>{{$balance->created_at->format('F j Y')}}</td>
                            
                        </tr>
                        @endforeach
                        
                        @if(!empty($balance))
                        <tfoot>
                            <td></td>
                            <td></td>
                            <td><strong>Total: {{$balance->sum('balance')}}</strong></td>
                            <td></td>
                            <td><strong>Total: {{$balance->sum('coins')}}</strong></td>
                            <td></td>
                        </tfoot>
                        @endif
                    </tbody>
                </table>
          </div>

          <div class="box-body table-responsive">
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
@endsection