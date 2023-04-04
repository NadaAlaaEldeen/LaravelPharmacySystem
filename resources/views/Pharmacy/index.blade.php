@extends('layouts.container')

@section('content')
@if(session('success'))
    <div class="col-lg-12">
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    </div>
@endif
<div class="card-header">
    <h3 class="card-title">Pharmacies DataTable</h3>
    <a href="{{route('pharmacy.create')}}" class="btn btn-info float-right"></i>Add new Pharmacy</a>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered user_datatable">
                <thead>
                    <tr>
                    <th>ID</th>
                        <th>Priority</th>
                        <th>Pharmacy Name</th>
                        <th>Area Name</th>
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
            ajax: "{{ route('pharmacies.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'priority',
                    name: 'priority'
                },
                {
                    data: 'Name',
                    name: 'Name'
                },
                {
                    data: 'area',
                    name: 'area'
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
