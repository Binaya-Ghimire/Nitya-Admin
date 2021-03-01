@extends('layouts.backend')
@section('admin-content')
    <div class="content-wrapper">
        <div class="box box-primary">
            @include('flashMsg.flashmessages')
            <div class="box-header">
                <h3>
                    Payment Status Lists
                </h3>
                <div class="pull-right"> 
                    <a href="{{route('create-payment-status')}}" class="btn btn-primary">Add Payment Status</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <th>S.No</th>
                        <th>Payment Status</th>
                        <th>Created Time</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($paymentStatuses as $paymentStatus)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$paymentStatus->status}}</td>
                                <td>{{$paymentStatus->created_at->format('l j F Y')}}</td>
                                <td>
                                    <a href="{{route('edit-payment-status', $paymentStatus)}}" class="btn btn-primary btn-sm"> Edit</a>

                                    <button class="btn btn-danger btn-flat btn-sm remove-paymentStatus" data-id="{{ $paymentStatus }}" data-action="{{ route('delete-payment-status',$paymentStatus) }}"> Delete</button>

                                    <!-- <form method="Post"  class="form-inline" action="{{route('delete-payment-status',$paymentStatus)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" onclick=" return confirm('Are You sure to delete?')" class="btn btn-danger btn-sm mb-2">Delete</button>
                                    </form> -->
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
  $("body").on("click",".remove-paymentStatus",function(){
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