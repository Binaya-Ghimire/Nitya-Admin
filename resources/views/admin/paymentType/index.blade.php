@extends('layouts.backend')
@section('admin-content')
    <div class="content-wrapper">
        <div class="box box-primary">
            @include('flashMsg.flashmessages')
            <div class="box-header">
                <h3>
                    Payment Types Lists
                </h3>
                <div class="pull-right"> 
                    <a href="{{route('create-payment-type')}}" class="btn btn-primary">Add Payment Type</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <th>S.No</th>
                        <th>Payment Type</th>
                        <th>Payment Status</th>
                        <th>Created Time</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($paymentTypes as $paymentType)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$paymentType->name}}</td>
                                <td>
                                    @if($paymentType->status ==1)
                                        <label class="badge badge-success">Active</label>
                                        <a href="{{route('deactivate-paymenttype', $paymentType)}}" class="btn btn-danger btn-xs">Deactivate</a>
                                    @else
                                        <label class="badge badge-danger">Deactive</label>
                                        <a href="{{route('activate-paymenttype',$paymentType)}}" class=" btn btn-success btn-xs">Activate</a>
                                    @endif

                                </td>
                                <td>{{$paymentType->created_at->format('l j F Y')}}</td>
                                <td>
                                    <a href="{{route('edit-payment-type', $paymentType)}}" class="btn btn-primary btn-sm"> Edit</a>

                                    <form method="Post" class="form-inline" action="{{route('delete-payment-type', $paymentType->id)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger btn-sm mb-2">Delete</button>
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