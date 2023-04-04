@extends('layouts.container')

@section('content')

<section class="container-fluid">
   <!-- content of page -->
   <h1 class="text-center">Pharmacy System Managment</h1>
   <div class="d-flex justify-content-center">
    <form action="{{route("medicines.store")}}" method="post" enctype="multipart/form-data" style="width: 600px;">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1">

        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Type</label>
            <input name="type" type="text" class="form-control" id="exampleFormControlInput2">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Price</label>
            <input name="price" type="text" class="form-control" id="exampleFormControlInput2">
        </div>
        
        <button class="btn btn-success" style="background-color:#6D9886 ; color:white">Submit</button>
    </form>
</div>
</section>


@endsection