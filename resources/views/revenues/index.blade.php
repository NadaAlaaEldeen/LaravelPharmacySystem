@extends('layouts.container')

@section('content')
<div class="card-header">
    <h3 class="card-title">Revenue DataTable</h3>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered user_datatable">
                <thead>
                    <tr>

                        <th>Pharmacy Name</th>
                        <th>Total Orders</th>
                        <th>Total Revenue</th>
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
            ajax: "{{ route('revenues.index') }}",
            columns: [
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'total_order',
                    name: 'total_order'
                },
                {
                    data: 'total_revenue',
                    name: 'total_revenue',
                },
            ]
        });
    });
</script>

@endsection
