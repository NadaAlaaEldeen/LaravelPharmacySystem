@extends("layouts.container")

@section('title')
Create Area
@endsection

@section('content')
<div class="card-header mb-5">
    <h3 class=" text-center">Create New Address For User</h3>
</div>
<div class="d-flex justify-content-center">
    <form action="{{route("addresses.store")}}" method="post" enctype="multipart/form-data" style="width: 600px;">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Stree_Name</label>
            <input name="street_name" type="text" class="form-control" id="exampleFormControlInput1"  placeholder="Street_Name">
        </div>
        <div class="form-group d-flex gap-3">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Building_Number</label>
                <input name="building_number" type="number" min="1" class="form-control" id="exampleFormControlInput2" placeholder="Srt_Num">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Floor_Number</label>
                <input name="floor_number" type="number" min="1" class="form-control" id="exampleFormControlInput2" placeholder="Floor_Num">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Flat_Number</label>
                <input name="flat_number" type="number" min="1" class="form-control" id="exampleFormControlInput2" placeholder="Flat_Num">
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Is_Main</label>
            <input name="is_main" type="text" class="form-control" id="exampleFormControlInput2">
        </div>
        <div class="form-group d-flex">
        <div class="mb-3 col-md-6">
                <label for="exampleFormControlTextarea1" class="form-label">User_ID</label>
                <select name="user_id" class="form-control">
                    @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->id}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-md-6">
                <label for="exampleFormControlTextarea1" class="form-label">Area_ID</label>
                <select name="area_id" class="form-control">
                    @foreach($areas as $area)
                            <option value="{{$area->id}}">{{$area->id}}</option>
                    @endforeach
                </select>
            </div>
       </div>

       <div class="d-flex justify-content-end">
       <button class="btn btn-success" style="background-color:#6D9886 ; color:white">Submit</button>
        </div>

    </form>
    </div>
@endsection
