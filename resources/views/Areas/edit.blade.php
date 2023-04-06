@extends('layouts.container')

@section('content')
<div class="d-flex justify-content-center">
    <!-- <div class="col-md-6" style="width: 440px;">
        <img src="Doctors_For_Men-732x549-thumbnail.jpg" >
    </div> -->
    <div class="card card-primary shadow border rounded p-4 mb-5 " style="width: 850px;">
        <div class="card-header d-flex justify-content-center">
            <h3 class="card-title">Edit area</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="d-flex justify-content-center">
        <form action="{{route("areas.update",$area->id)}}" method="post" enctype="multipart/form-data" style="width: 800px;">
            <div class="card-body row g-3">
                @csrf
                @method("put")
                <div class="form-group col-md-6">
                    <label for="Area-name">Name</label>
                    <input type="text" value="{{$area->name}}" class="form-control @error('name') is-invalid @enderror"
                           name="name" id="Area-name"
                           placeholder="Enter Area">
                </div>
                <div class="form-group col-md-6">
                    <label for="type">address</label>
                    <input type="text" value="{{$area->address}}"
                           class="form-control @error('type') is-invalid @enderror" name="address" id="address"
                           placeholder="Enter Address">

                </div>
                

                </div>
            <br>
            <!-- /.card-body -->

            <div class="card-footer d-flex justify-content-end" style="width: 800px;">
                <button type="submit" class="btn btn-primary">update</button>
            </div>

        </form>
    </div>
    </div>
</div>
@endsection
