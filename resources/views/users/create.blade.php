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
    <h3 class=" text-center">Create New Client</h3>
</div>
<div class="d-flex justify-content-center ">
    <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data" class="p-5 shadow-sm" style="width:70%">
        @csrf
        
        <div class="form-group d-flex">
            <div class="form-group col-md-6">
                <label for="exampleFormControlTextarea1" class="form-label">Client Name</label>
                <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name">
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputPhone1">Phone</label>
                <input type="text" name="mobile" class="form-control" id="exampleInputPhone1" placeholder="Enter Phone">              
            </div> 
        </div>
        <div class="form-group d-flex">
            <div class="form-group col-md-6">
                <label for="exampleFormControlTextarea1" class="form-label"> National_id</label>
                <input name="national_id" type="text" class="form-control" id="exampleFormControlInput1"placeholder="Enter Naitional_ID">
            </div>
            <div class="form-group col-md-6">
                <label>date of birth</label>
                <input type="date" name="date_of_birth"  class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
            </div>
        </div>
        <div class="form-group d-flex">
            <div class="form-group col-md-6">
                <label for="exampleFormControlTextarea1" class="form-label"> Email Addess</label>
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
        <div class="form-group">
            <label for="price">Is_Inquired:</label><br>
            <input type="radio"  name="is_inquired" value="0">
            <label for="age1">No</label><br>
            <input type="radio" name="is_inquired" value="1">
            <label for="age2">Yes</label><br> 
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-success" type="submit" style="background-color:#6D9886 ; color:white">Submit</button>
        </div>
    </form>
    </div>
@endsection
