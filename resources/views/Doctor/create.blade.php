@extends('layouts.container')

@section('content')
    <div class="d-flex justify-content-center">
    <form action="{{route("doctor.store")}}" method="post" enctype="multipart/form-data" style="width: 600px;">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1"  >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Email</label>
            <input name="email" class="form-control" id="exampleFormControlInput1"rows="3"   >
        </div>


        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="exampleFormControlInput1"   >
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">National_Id</label>
            <input name="national_id" type="text" class="form-control" id="exampleFormControlInput1"   >
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">pharmacy_id</label>
            <input name="pharmacy_id" type="text" class="form-control" id="exampleFormControlInput1"   >
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Avatar</label>
            <input type="file" name="avatar" class="form-control" id="exampleFormControlTextarea1" rows="3">
        </div>

        <button class="btn btn-success" style="background-color:#6D9886 ; color:white">Submit</button>

</form>
    </div>
@endsection
