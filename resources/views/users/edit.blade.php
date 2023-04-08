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
            <form action="{{route("users.update",$client->id)}}" method="post" enctype="multipart/form-data"style="width: 800px;">
                <div class="card-body row g-3">
                    @csrf
                    @method("put")
                    <div class="form-group col-md-6">
                    <label for="priority">Client Name</label>
                    <input type="text" value="{{$client->user->name}}" class="form-control"
                           name="user_name" >
                    </div>
                    <div class="form-group col-md-6">
                    <label for="priority">Client Email</label>
                    <input type="text" value="{{$client->user->email}}" class="form-control"
                           name="user_mail" >
                    </div>
                    <div class="form-group col-md-6">
                    <label for="priority">National_Id</label>
                    <input type="text" value="{{$client->user->national_id}}" class="form-control"
                           name="national_id" >
                    </div>
                    <div class="form-group col-md-6">
                    <label for="priority">Phone</label>
                    <input type="text" value="{{$client->user->mobile}}" class="form-control"
                           name="mobile" >
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Avatar Image</label><br>
                        @if ($client->user->avatar) 
                        <img src="{{asset('storage/'.$client->user->avatar)}}"  alt="photo" style="height:30%;width:20%"> <br><br> 
                        @else
                        <p>No provided image</p>
                        @endif
                        <input class="form-control form-control-lg" id="formFileLg" name="avatar" type="file">
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