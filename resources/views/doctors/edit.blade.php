@extends('layouts.container')

@section('content')
<div class="d-flex justify-content-center">
    <div class="card card-primary shadow border rounded p-4 mb-5 " style="width: 850px;">
        <div class="card-header d-flex justify-content-center bg-primary text-white">
            <h3 class="card-title">Edit Doctor</h3>
        </div>
        <div class="d-flex justify-content-center">
        <form action="{{route("doctors.update",$doctor->id)}}" method="post" enctype="multipart/form-data" style="width: 800px;">
            <div class="card-body row g-3">
                @csrf
                @method("put")
                <div class="form-group col-md-6">
                    <label for="Doctor-name">Name</label>
                    <input type="text" value="{{$doctor->user->name}}" class="form-control @error('name') is-invalid @enderror"
                        name="name" id="Doctor-name"
                        placeholder="Enter Doctor name">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email address</label>
                    <input type="email" value="{{$doctor->user->email}}"
                        class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                        placeholder="Enter email">

                </div>
                <div class="form-group">
                    <label for="national-id">National id</label>
                    <input type="text" value="{{$doctor->user->national_id}}"
                    class="form-control @error('nationa_id') is-invalid @enderror" name="national_id"
                        id="national-id"
                        placeholder="Enter national id">
                </div>

                <div class="form-group">
                    <label for="date-of-birth">is ban</label>
                    <select class="form-control" name="is_ban" id="is_ban" placeholder="0" value="{{$doctor->is_ban}}">
                        <option value="{{$doctor->is_ban}}" >0</option>
                        <option value="{{$doctor->is_ban}}">1</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Avatar</label>
                    <input type="file" name="avatar" class="form-control" id="exampleFormControlTextarea1" rows="3"  value="{{$doctor->user->avatar}}">
                </div>
                </div>
            <div class=" d-flex justify-content-end" style="width: 800px;">
                <button type="submit" class="btn btn-primary me-5">update</button>
            </div>
        </form>
    </div>
    </div>
</div>

@endsection
