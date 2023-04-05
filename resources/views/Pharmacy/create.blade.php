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
    <h3 class=" text-center">Create New Medicine</h3>
</div>
<div class="d-flex justify-content-center">
    <form action="{{route('pharmacy.store')}}" method="post" enctype="multipart/form-data" style="width: 600px;">
        @csrf

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Owner Pharmacy Name</label>
            <input name="owner_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Owner Name">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Owner Pharmacy Email Addess</label>
            <input name="owner_mail" type="text" class="form-control" id="exampleFormControlInput1"placeholder="Owner Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">                
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Owner Pharmacy National_id</label>
            <input name="national_id" type="text" class="form-control" id="exampleFormControlInput1"placeholder="Owner Naitional_ID">
        </div>
        <div class="form-group">
             <label for="exampleInputPhone1">Gender</label>
                <select class="form-control" name="gender" id="gender" placeholder="Owner Gender">
                    <option value="male" >male</option>
                    <option value="female">female</option>
                </select>
        </div>        
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Pharmacy Name</label>
            <input name="pharmacy_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Pharmacy Name">

        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Priority</label>
            <input name="priority" type="text" class="form-control" id="exampleFormControlInput1"placeholder="Pharmacy Priority">

        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Area_id</label>
            <input name="area_id" type="text" class="form-control" id="exampleFormControlInput2" >
        </div>

        <button class="btn btn-success" type="submit" style="background-color:#6D9886 ; color:white">Submit</button>
    </form>
    </div>
@endsection
