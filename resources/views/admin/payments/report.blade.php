@extends('layouts.backend')
@section('admin-content')
    <div class="content-wrapper">
        <div class="box box-primary">
            @include('flashMsg.flashmessages')
            <div class="box-header">
                <h3>
                    Payment Report
                </h3>
            </div>
            <div class="box-body table-responsive">
                <div class="top-form">
                  <form class="form-inline" method="post" action="{{route('fetch-report')}}">
                    @csrf

                    <label for="email">User:</label>
                    <select class="form-control" name="user_id">
                        @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>

                    <label for="pwd">From date:</label>
                    <input type="date" class="form-control" id="pwd" name="start_date" >

                    <label for="pwd">To date:</label>
                    <input type="date" class="form-control" id="pwd" name="end_date" >

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
                <table class="table table-hover" id="myTable">
                    <thead>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>Balance</th>
                        <th>Rate</th>
                        <th>Coins</th>
                        <th>Payment Type</th>
                        <th>Added By</th>
                        <th>Created Time</th>
                    </thead>
                    <tbody>
                        @foreach($user_history as $history)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$history->user->name}}</td>
                            <td>{{$history->balance}}</td>
                            <td>{{$history->rate_per_sms}}</td>
                            <td>{{$history->coins}}</td>
                            <td>
                                @if(!is_null($history->payment_type))
                                {{$history->paymentType->name}}</td>
                                @endif
                            <td>{{$history->addedBy->name}}</td>
                            <td>{{$history->created_at->format('F j Y')}}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
          </div>
        </div>
    </div>
@endsection