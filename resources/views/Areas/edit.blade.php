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

                <div class="form-group col-md-6">
                    <label for="price">Created_at</label>
                    <input type="text" class="form-control @error('created_at') is-invalid @enderror" name="created_at"
                           id="created_at" value="{{$area->created_at}}"
                           placeholder="Enter created date">

                </div>

                <div class="form-group">
                    <label for="phone">Updated_at</label>
                    <input type="text" value="{{$area->updated_at}}"
                           class="form-control @error('updated_at') is-invalid @enderror" name="updated_at" id="updated_at"
                           placeholder="Enter updated date">

                </div>

                </div>

                    </div>

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
