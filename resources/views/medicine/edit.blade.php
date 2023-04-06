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
    @if(session('success'))
    <div class="col-lg-12">
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    </div>
@endif
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
                        <label for="Doctor-name">Medicine Name</label>
                        <input type="text" value="{{$medicine->name}}"
                            class="form-control @error('name') is-invalid @enderror" name="name" id="Medicine-name"
                            placeholder="Enter Medicine name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleFormControlTextarea1" class="form-label">Type Medicine</label>
                        <select name="type" class="form-control">
                            <option value="{{$medicine->type}}">{{$medicine->type}}</option>
                            <option value="Tablet">Tablet</option>
                            <option value="Syrup">Syrup</option>
                            <option value="Cream">Cream</option>
                            <option value="Suppository">Suppository</option>
                            <option value="Ampol">Ampol</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="national-id">Price</label>
                        <input type="number" min=10 value="{{$medicine->price}}"
                            class="form-control @error('price') is-invalid @enderror" name="price" id="price"
                            placeholder="Enter price">
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