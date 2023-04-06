@extends("layouts.container")

@section("content")
<div class="d-flex justify-content-center">
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
                    <input type="number" value="{{$address->building_number}}"
                           class="form-control @error('type') is-invalid @enderror" name="building_number" id="address"
                           placeholder="Enter Address">

                </div>

                <div class="form-group col-md-6">
                    <label for="price">Floor_Number</label>
                    <input type="number" class="form-control @error('created_at') is-invalid @enderror" name="floor_number"
                           id="created_at" value="{{$address->floor_number}}"
                           placeholder="Enter created date">

                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Flat_Number</label>
                    <input type="number" value="{{$address->flat_number}}"
                           class="form-control @error('updated_at') is-invalid @enderror" name="flat_number" id="updated_at"
                           placeholder="Enter updated date">
                </div>
                <div class="form-group col-md-6">
                <label for="price">Is_Main:</label><br>
                    <input type="radio"  name="is_main" value="0">
                    <label for="age1">No</label><br>
                    <input type="radio" name="is_main" value="1">
                    <label for="age2">Yes</label><br> 
                </div>
                
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Area_ID</label>
                    <select name="area_id" class="form-control">
                        <option value="{{$address->area_id}}">{{$address->area_id}}</option>
                        @foreach($areas as $area)
                            <option value="{{$area->id}}">{{$area->id}}</option>
                        @endforeach
                    </select>
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
