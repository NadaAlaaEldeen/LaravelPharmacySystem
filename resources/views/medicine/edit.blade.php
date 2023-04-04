@extends('layouts.container')

@section('content')
<div class="d-flex justify-content-center">
    <div class="card card-primary shadow border rounded p-4 mb-5 " style="width: 850px;">
        <div class="card-header d-flex justify-content-center">
            <h3 class="card-title">Edit Medicine</h3>
        </div>
        <div class="d-flex justify-content-center">
            <form action="{{route("medicines.update",$medicine->id)}}" method="post" enctype="multipart/form-data"
                style="width: 800px;">
                <div class="card-body row g-3">
                    @csrf
                    @method("put")
                    <div class="form-group col-md-6">
                        <label for="Doctor-name">Name</label>
                        <input type="text" value="{{$medicine->name}}"
                            class="form-control @error('name') is-invalid @enderror" name="name" id="Medicine-name"
                            placeholder="Enter Medicine name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="type">Type</label>
                        <input type="text" value="{{$medicine->type}}"
                            class="form-control @error('type') is-invalid @enderror" name="type" id="type"
                            placeholder="Enter type">

                    </div>
                    <div class="form-group">
                        <label for="national-id">Price</label>
                        <input type="text" value="{{$medicine->price}}"
                            class="form-control @error('price') is-invalid @enderror" name="price" id="price"
                            placeholder="Enter price">


                    </div>
                    <div class="form-group col-md-6">
                        <label for="price">Created_at</label>
                        <input type="text" class="form-control @error('created_at') is-invalid @enderror"
                            name="created_at" id="created_at" value="{{$medicine->created_at}}"
                            placeholder="Enter created date">

                    </div>

                    <div class="form-group">
                        <label for="phone">Updated_at</label>
                        <input type="text" value="{{$medicine->updated_at}}"
                            class="form-control @error('updated_at') is-invalid @enderror" name="updated_at"
                            id="updated_at" placeholder="Enter updated date">

                    </div>
                    <br>
                    <div class="card-footer d-flex justify-content-end" style="width: 800px;">
                        <button type="submit" class="btn btn-primary">update</button>
                    </div>

                </div>


            </form>
        </div>
    </div>
</div>

@endsection