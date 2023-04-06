@extends("layouts.container")

@section('title')
Create Area
@endsection

@section('content')
<div class="d-flex justify-content-center">
    <form action="{{route("addresses.store")}}" method="post" enctype="multipart/form-data" style="width: 600px;">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Stree_Name</label>
            <input name="street_name" type="text" class="form-control" id="exampleFormControlInput1">

            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Building_Number</label>
            <input name="building_number" type="text" class="form-control" id="exampleFormControlInput2">
        </div>

        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Floor_Number</label>
            <input name="floor_number" type="text" class="form-control" id="exampleFormControlInput2">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Flat_Number</label>
            <input name="flat_number" type="text" class="form-control" id="exampleFormControlInput2">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Is_Main</label>
            <input name="is_main" type="text" class="form-control" id="exampleFormControlInput2">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Area_id</label>
            <input name="area_id" type="text" class="form-control" id="exampleFormControlInput2">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">User_id</label>
            <input name="user_id" type="text" class="form-control" id="exampleFormControlInput2">
        </div>

        <button class="btn btn-success" style="background-color:#6D9886 ; color:white">Submit</button>
    </form>
    </div>
@endsection
