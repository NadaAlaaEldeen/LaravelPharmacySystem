@extends('layouts.container')

@section('content')
@if(session('success'))
    <div class="col-lg-12">
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    </div>
@endif
<div class="card-header">
    <h3 class="card-title">Doctors DataTable</h3>
    <a href="{{route('doctors.create')}}" class="btn btn-info float-right"></i>Add new Doctor</a>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered user_datatable">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Doctor Name</th>
                    <th>Pharmacy Name</th>
                    <th>created_at</th>
                    <th>Ban</th>
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
            ajax: "{{ route('doctors.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'Name',
                    name: 'Name'
                },
                {
                    data: 'pharmacy',
                    name: 'pharmacy'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'is_ban',
                    name: 'is_ban'
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
