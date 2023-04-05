@extends("layouts.container")

@section("content")
<div class="d-flex justify-content-center">
    <!-- <div class="col-md-6" style="width: 440px;">
        <img src="Doctors_For_Men-732x549-thumbnail.jpg" >
    </div> -->
    <div class="card card-primary shadow border rounded p-4 mb-5 " style="width: 850px;">
        <div class="card-header d-flex justify-content-center">
            <h3 class="card-title">Edit address</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="d-flex justify-content-center">
        <form action="{{route("addresses.update",$address->id)}}" method="post" enctype="multipart/form-data" style="width: 800px;">
            <div class="card-body row g-3">
                @csrf
                @method("put")
                <div class="form-group col-md-6">
                    <label for="Area-name">Street_Name</label>
                    <input type="text" value="{{$address->street_name}}" class="form-control @error('name') is-invalid @enderror"
                           name="street_name" id="Area-name"
                           placeholder="Enter Area">
                </div>
                <div class="form-group col-md-6">
                    <label for="type">Building_Number</label>
                    <input type="text" value="{{$address->building_number}}"
                           class="form-control @error('type') is-invalid @enderror" name="building_number" id="address"
                           placeholder="Enter Address">

                </div>

                <div class="form-group col-md-6">
                    <label for="price">Floor_Number</label>
                    <input type="text" class="form-control @error('created_at') is-invalid @enderror" name="floor_number"
                           id="created_at" value="{{$address->floor_number}}"
                           placeholder="Enter created date">

                </div>

                <div class="form-group col-md-6">
                    <label for="price">Is_Main</label>
                    <input type="text" class="form-control @error('created_at') is-invalid @enderror" name="is_main"
                           id="created_at" value="{{$address->is_main}}"
                           placeholder="Enter created date">

                </div>

                <div class="form-group">
                    <label for="phone">Flat_Number</label>
                    <input type="text" value="{{$address->flat_number}}"
                           class="form-control @error('updated_at') is-invalid @enderror" name="flat_number" id="updated_at"
                           placeholder="Enter updated date">

                </div>
                <div class="form-group">
                    <label for="phone">Area_id</label>
                    <input type="text" value="{{$address->area_id}}"
                           class="form-control @error('updated_at') is-invalid @enderror" name="area_id" id="updated_at"
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
