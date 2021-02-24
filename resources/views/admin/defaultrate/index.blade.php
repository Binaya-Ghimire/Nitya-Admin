@extends('layouts.backend')
@section('admin-content')
    <div class="content-wrapper">
        <div class="box box-primary">
            @include('flashMsg.flashmessages')
            <div class="box-header">
                <h3>
                    Default Rate For Each Message
                </h3>
                @if(!count($rates))
                <div class="pull-right"> 
                    <a href="{{route('create-default-rate')}}" class="btn btn-primary">Add Default Rate</a>
                </div>
                @endif
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <th>S.No</th>
                        <th>Rate</th>
                        <th>Created By</th>
                        <th>Created Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($rates as $rate)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$rate->default_rate}}</td>
                                <td>{{$rate->createdBy->name}}</td>
                                <td>{{$rate->created_at->format('l j F Y')}}</td>
                                
                                <td>
                                    <a href="{{route('edit-default-rate', $rate->id)}}" class="btn btn-sm btn-success" >Edit</a>
                                </td>
                            </tr>
                        @endforeach  
                  </tbody>
                </table>
          </div>
        </div>
    </div>
@endsection