@extends('layouts.container')

@section('content')

@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<section class="container-fluid">
   <!-- content of page -->
   <div class="card-header mb-5">
    <h3 class=" text-center">Create New Medicine</h3>
</div>
   <div class="d-flex justify-content-center">
    <form action="{{route("medicines.store")}}" method="post" enctype="multipart/form-data" style="width: 600px;">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Medicine Name</label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Name">

        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Type Medicine</label>
            <select name="type" class="form-control">
            <option value="">Choose type of medicine</option>
                <option value="Tablet">Tablet</option>
                <option value="Syrup">Syrup</option>
                <option value="Cream">Cream</option>
                <option value="Suppository">Suppository</option>
                <option value="Ampol">Ampol</option>
            </select>
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