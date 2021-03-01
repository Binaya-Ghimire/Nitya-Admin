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

                                    <button class="btn btn-danger btn-flat btn-sm remove-paymentType" data-id="{{ $paymentType }}" data-action="{{ route('delete-payment-type',$paymentType) }}"> Delete</button>
                                </td>
                            </tr>
                        @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
  $("body").on("click",".remove-paymentType",function(){
    var current_object = $(this);
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this after you delete!",
        type: "error",
        showCancelButton: true,
        dangerMode: true,
        cancelButtonClass: '#DD6B55',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Delete',
    },function (result) {
        if (result) {
            var action = current_object.attr('data-action');
            var token = jQuery('meta[name="csrf-token"]').attr('content');
            var id = current_object.attr('data-id');

            $('body').html("<form class='form-inline remove-form' method='post' action='"+action+"'></form>");
            $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
            $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
            $('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
            $('body').find('.remove-form').submit();
        }
    });
});
</script>
@endsection