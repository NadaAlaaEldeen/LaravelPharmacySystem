@extends("layouts.app")

@section("title","Edit Pharmacy")

@section("style")

@endsection

@section("header","Edit Pharmacy")

@section("breadcrumb")


@endsection

@section("content")
<div class="d-flex justify-content-center">
    <!-- <div class="col-md-6" style="width: 440px;">
        <img src="Doctors_For_Men-732x549-thumbnail.jpg" >
    </div> -->
    <div class="card card-primary shadow border rounded p-4 mb-5 " style="width: 850px;">
        <div class="card-header d-flex justify-content-center">
            <h3 class="card-title">Edit Pharmacy</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="d-flex justify-content-center">
        <form action="{{route("pharmacy.update",$pharmacy->id)}}" method="post" enctype="multipart/form-data" style="width: 800px;">
            <div class="card-body row g-3">
                @csrf
                @method("put")
                <div class="form-group col-md-6">
                    <label for="priority">Name</label>
                    <input type="text" value="{{$pharmacy->name}}" class="form-control @error('priority') is-invalid @enderror"
                           name="name" id="priority"
                           placeholder="Enter priority">
                </div>
                <div class="form-group col-md-6">
                    <label for="priority">Priority</label>
                    <input type="text" value="{{$pharmacy->priority}}" class="form-control @error('priority') is-invalid @enderror"
                           name="priority" id="priority"
                           placeholder="Enter priority">
                </div>
                <div class="form-group col-md-6">
                    <label for="type">Owner</label>
                    <input type="text" value="{{$pharmacy->owner_user_id}}"
                           class="form-control @error('owner') is-invalid @enderror" name="owner" id="owner"
                           placeholder="Enter ower">

                </div>
                <div class="form-group">
                    <label for="national-id">Area_id</label>
                    <input type="text" value="{{$pharmacy->area_id}}"
                    class="form-control @error('area_id') is-invalid @enderror" name="area_id"
                           id="area_id"
                           placeholder="Enter area">


                </div>
                <div class="form-group col-md-6">
                    <label for="price">Created_at</label>
                    <input type="text" class="form-control @error('created_at') is-invalid @enderror" name="created_at"
                           id="created_at" value="{{$pharmacy->created_at}}"
                           placeholder="Enter created date">

                </div>

                <div class="form-group">
                    <label for="phone">Updated_at</label>
                    <input type="text" value="{{$pharmacy->updated_at}}"
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
