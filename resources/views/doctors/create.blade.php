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
    <h3 class=" text-center">Create New Doctor</h3>
</div>
<div class="d-flex justify-content-center ">
    <form action="{{route('doctors.store')}}" method="post" enctype="multipart/form-data" class="p-5 shadow-sm" style="width:70%">
        @csrf

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Doctor Name</label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Doctor Name">
        </div>
        <div class="form-group d-flex">
            <div class="form-group col-md-6">
                <label for="exampleFormControlTextarea1" class="form-label">Doctor Email</label>
                <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter Doctor Email">
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputPhone1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPhone1" placeholder="Enter Password">
            </div>
        </div>
        <div class="form-group d-flex">
            <div class="form-group col-md-6">
                <label for="exampleFormControlTextarea1" class="form-label">Phone</label>
                <input name="phone" type="text" class="form-control" id="exampleFormControlInput1"placeholder="Enter Phone Number">
            </div>
            <div class="form-group col-md-6">
                <label>date of birth</label>
                <input type="date" name="date_of_birth"  class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
            </div>
        </div>
        <div class="form-group d-flex">
            <div class="form-group col-md-6">
                <label for="exampleFormControlTextarea1" class="form-label">National_id</label>
                <input name="national_id" type="text" class="form-control" id="exampleFormControlInput1"placeholder="Enter National_id">
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Is_ban</label>
                <select class="form-control" name="is_ban" id="gender" placeholder="0">
                        <option value="0" >0</option>
                        <option value="1">1</option>
                </select>
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
                <label for="exampleInputPhone1">Pharmacy_id</label>
                <input name="pharmacy_id" type="text" class="form-control" id="exampleFormControlInput1"placeholder="Enter Pharmacy_id">
            </div>
        </div>
            <div class="form-group col-md-12">
                <label>Avatar Image</label>
                <input class="form-control form-control" id="formFileLg" name="avatar" type="file">
            </div>


       </div>
        <div class="d-flex justify-content-center">
            <button class="btn btn-success" type="submit" style="background-color:#6D9886 ; color:white">Submit</button>
        </div>
    </form>
    </div>
@endsection
