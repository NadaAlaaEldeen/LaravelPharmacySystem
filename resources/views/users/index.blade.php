@extends('layouts.container')

@section('content')
@if(session('fail'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>{{ session('fail') }}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('success'))
    <div class="col-lg-12">
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    </div>
@endif
<div class="card-header mb-5">
    <h3 class="card-title">Pharmacies DataTable</h3>
    <a href="{{route('users.create')}}" class="btn btn-info float-right"></i>Add new Client</a>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered user_datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client Name</th>
                        <th>Client Email</th>
                        <th>Is_inquired</th>
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
            ajax: "{{ route('users.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'Name',
                    name: 'Name'
                },
                {
                    data: 'Email',
                    name: 'Email'
                },
                {
                    data: 'is_inquired',
                    name: 'is_inquired'
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