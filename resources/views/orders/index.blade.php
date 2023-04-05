@extends('layouts.container')

@section('content')
@if(session('success'))
    <div class="col-lg-12">
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    </div>
@endif
<div class="card-header">
    <h3 class="card-title">Orders DataTable</h3>
    <a href="{{route('orders.create')}}" class="btn btn-info float-right"></i>Add new Order</a>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered user_datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Status</th>
                        <th>Total Price</th>
                        <th>User Name</th>
                        <th>Doctor Name</th>
                        <th>Doctor Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(function() {
        var table = $('.user_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('orders.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'medicine',
                    name: 'medicine'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'is_insured',
                    name: 'is_insured'
                },

                {
                    data: 'user_id',
                    name: 'user_id'
                },
                {
                    data: 'pharmacy',
                    name: 'pharmacy'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
</script>

@endsection
