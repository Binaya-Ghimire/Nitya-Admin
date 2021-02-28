@extends('layouts.backend')
@section('admin-content')
    <div class="content-wrapper">
        <div class="box box-primary">
            @include('flashMsg.flashmessages')
            <div class="box-header">
                <h3>
                    Balance Report
                </h3>
            </div>
            <div class="box-body table-responsive">
                <div class="top-form">
                  <form class="form-inline" method="post" action="{{route('get-balance-report')}}">
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
                        <th>Created Time</th>
                    </thead>
                    <tbody>
                        @foreach($balances as $balance)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$balance->user->name}}</td>
                            <td>{{$balance->balance}}</td>
                            <td>{{$balance->rate_per_sms}}</td>
                            <td>{{$balance->coins}}</td>
                            <td>{{$balance->created_at->format('F j Y')}}</td>
                            
                        </tr>
                        @endforeach
                        <tfoot>
                            <td></td>
                            <td></td>
                            <td><strong>Total: {{$balance->sum('balance')}}</strong></td>
                            <td></td>
                            <td><strong>Total: {{$balance->sum('coins')}}</strong></td>
                            <td></td>
                        </tfoot>
                    </tbody>
                   
                </table>
          </div>
        </div>
    </div>
@endsection