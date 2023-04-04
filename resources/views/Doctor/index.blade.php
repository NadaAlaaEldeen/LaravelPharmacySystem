@extends('layouts.container')

@section('content')
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