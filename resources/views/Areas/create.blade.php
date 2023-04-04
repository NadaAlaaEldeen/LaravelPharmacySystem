@extends("layouts.app")

@section('title')
Create Area
@endsection

@section('content')

<div class="d-flex justify-content-center">
    <form action="{{route("areas.store")}}" method="post" enctype="multipart/form-data" style="width: 600px;">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1">

        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">address</label>
            <input name="address" type="text" class="form-control" id="exampleFormControlInput2">
        </div>

        <button class="btn btn-success" style="background-color:#6D9886 ; color:white">Submit</button>
    </form>
</div>
@endsection