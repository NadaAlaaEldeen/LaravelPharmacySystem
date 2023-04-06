@extends("layouts.container")

@section('title')
    Create Pharmacy
@endsection

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

<div class="card-header mb-5">
    <h3 class=" text-center">Create New Pharmacy</h3>
</div>
<div class="d-flex justify-content-center ">
    <form action="{{route('pharmacies.store')}}" method="post" enctype="multipart/form-data" class="p-5 shadow-sm" style="width:70%">
        @csrf
        
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Pharmacy Name</label>
            <input name="pharmacy_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Pharmacy Name">
        </div>
        <div class="form-group d-flex">
            <div class="form-group col-md-6">
                <label for="exampleFormControlTextarea1" class="form-label">Owner Pharmacy Name</label>
                <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name">
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputPhone1">Phone</label>
                <input type="text" name="mobile" class="form-control" id="exampleInputPhone1" placeholder="Enter Phone">              
            </div> 
        </div>
        <div class="form-group d-flex">
            <div class="form-group col-md-6">
                <label for="exampleFormControlTextarea1" class="form-label">Owner Pharmacy National_id</label>
                <input name="national_id" type="text" class="form-control" id="exampleFormControlInput1"placeholder="Enter Naitional_ID">
            </div>
            <div class="form-group col-md-6">
                <label>date of birth</label>
                <input type="date" name="date_of_birth"  class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
            </div>
        </div>
        <div class="form-group d-flex">
            <div class="form-group col-md-6">
                <label for="exampleFormControlTextarea1" class="form-label">Owner Pharmacy Email Addess</label>
                <input name="email" type="text" class="form-control" id="exampleFormControlInput1"placeholder="Enter Email">
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">                
            </div>
        </div>
        <div class="form-group d-flex">
            <div class="form-group col-md-6">
                <label for="exampleInputPhone1">Gender</label>
                    <select class="form-control" name="gender" id="gender" placeholder="Enter Gender">
                        <option value="male" >male</option>
                        <option value="female">female</option>
                    </select>
            </div>      
            <div class="form-group col-md-6">
                <label>Avatar Image</label>
                <input class="form-control form-control" id="formFileLg" name="avatar" type="file">
            </div>
        </div>
        
        <div class="form-group d-flex">
            <div class="mb-3 col-md-6">
                <label for="exampleFormControlTextarea1" class="form-label">Priority</label>
                <input name="priority" type="text" class="form-control" id="exampleFormControlInput1"placeholder="Enter Priority">

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
            <button class="btn btn-success" type="submit" style="background-color:#6D9886 ; color:white">Submit</button>
        </div>
    </form>
    </div>
@endsection
