@extends('layouts.container')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered user_datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Area Name</th>
                        <th>Street Name</th>
                        <th>Buildig Number</th>
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
            ajax: "{{ route('addresses.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'Name',
                    name: 'Name'
                },
                {
                    data: 'Address',
                    name: 'Address'
                },
                {
                    data: 'street_name',
                    name: 'street_name'
                },
                {
                    data: 'building_number',
                    name: 'building_number'
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