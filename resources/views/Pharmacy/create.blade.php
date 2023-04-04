@extends("layouts.app")

@section('title')
    Create Pharmacy
@endsection

@section('content')

    <div class="d-flex justify-content-center">
    <form action="{{route('pharmacy.store')}}" method="post" enctype="multipart/form-data" style="width: 600px;">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1">

        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Priority</label>
            <input name="priority" type="text" class="form-control" id="exampleFormControlInput1">

        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Owner</label>
            <input name="owner" type="text" class="form-control" id="exampleFormControlInput2">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Area_id</label>
            <input name="area_id" type="text" class="form-control" id="exampleFormControlInput2">
        </div>
        <!-- <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Image Avatar</label>
            <input type="file" name="image" class="form-control" id="exampleFormControlTextarea1" >
        </div> -->


        <button class="btn btn-success" type="submit" style="background-color:#6D9886 ; color:white">Submit</button>
    </form>
    </div>
@endsection
