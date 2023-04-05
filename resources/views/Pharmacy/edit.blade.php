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

<div class="d-flex justify-content-center">
    <div class="card card-primary shadow border rounded p-4 mb-5 " style="width: 850px;">
        <div class="card-header d-flex justify-content-center">
            <h3 class="card-title">Edit Pharmacy</h3>
        </div>
        <div class="d-flex justify-content-center">
            <form action="{{route("pharmacy.update",$pharmacy->id)}}" method="post" enctype="multipart/form-data"
                style="width: 800px;">
                <div class="card-body row g-3">
                    @csrf
                    @method("put")
                    <div class="form-group col-md-6">
                    <label for="priority">Owner Name</label>
                    <input type="text" value="{{$pharmacy->user->name}}" class="form-control"
                           name="user_name" >
                    </div>
                    <div class="form-group col-md-6">
                    <label for="priority">Owner Email</label>
                    <input type="text" value="{{$pharmacy->user->email}}" class="form-control"
                           name="user_mail" >
                    </div>
                    <div class="form-group col-md-6">
                    <label for="priority">Pharmacy Name</label>
                    <input type="text" value="{{$pharmacy->name}}" class="form-control" name="name">
                    </div>
            
                @role('admin')
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Area_ID</label>
                    <select name="area_id" class="form-control">
                        <option value="{{$pharmacy->area_id}}">{{$pharmacy->area_id}}</option>
                        @foreach($areas as $area)
                            <option value="{{$area->id}}">{{$area->id}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                        <label for="priority">Priority</label>
                        <input type="text" value="{{$pharmacy->priority}}" class="form-control "
                           name="priority" id="priority">
                    </div>
                @endrole

                @role('pharmacy')
                <div class="form-group col-md-6">
                    <label for="priority">Area_ID</label>
                    <input type="text" value="{{$pharmacy->area_id}}" class="form-control" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="priority">Priority</label>
                    <input type="text" value="{{$pharmacy->priority}}" class="form-control readon;" readonly>
                    </div>    
                @endrole

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


<!-- <input type="text" value="{{$pharmacy->user->name}}" class="form-control @error('priority') is-invalid @enderror" -->