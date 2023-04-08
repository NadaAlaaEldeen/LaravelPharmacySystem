@extends('layouts.container')

@section('content')

<div class="col-lg-7 shadow border rounded p-4 mb-5 d-flex justify-content-center" style="margin-left: 250px;">
    <div class="card-body">
        <h1 class="text-primary" style="margin-left: 190px;">Total Revenun</h1>
        <br>
        <br>
        <span style="font-size: 35px; font-weight: bold; margin-left: 160px;">{{$pharmacyName}}: </span>
        <span style="font-size: 35px; font-weight: bold; margin-left: 10px;">{{$pharmacyRevenue}}$</span>
    </div>
</div>
@endsection
