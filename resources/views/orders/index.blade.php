@extends('layouts.container')

@section('content')
@if(session('success'))
    <div class="col-lg-12">
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    </div>
@endif
<div class="card-header mb-5">
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
                        <th>Doctor Name</th>
                        <th>Pharmacy Name</th>
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
<<<<<<< HEAD:resources/views/Doctor/index.blade.php
            ajax: "{{ route('doctors.index') }}",
            columns: [
                {
=======
            ajax: "{{ route('orders.index') }}",
            columns: [{
>>>>>>> a8cbc573ddfd54b19952284afcc01b4265e50409:resources/views/orders/index.blade.php
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'total_price',
                    name: 'total_price'
                },
                {
<<<<<<< HEAD:resources/views/Doctor/index.blade.php
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, full, meta) {
                        return moment(data).format('YYYY-MM-DD');
                    }
=======
                    data: 'doctor',
                    name: 'doctor'
>>>>>>> a8cbc573ddfd54b19952284afcc01b4265e50409:resources/views/orders/index.blade.php
                },
                {
                    data: 'pharmacy_name',
                    name: 'pharmacy_name'
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

<<<<<<< HEAD:resources/views/Doctor/index.blade.php

@endsection
=======
@endsection
>>>>>>> a8cbc573ddfd54b19952284afcc01b4265e50409:resources/views/orders/index.blade.php
