@extends('layouts.container')

@section('content')
<section>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card text-center p-5 shadow border rounded">
                        <div class="card-body">
                         <img src="{{asset($doctor->user->avatar)}}" class="img-fluid rounded-3 " style="height: 150px; width: 150px ;margin-top:20px" >
                         <br><br>
                            <h2>Dr: {{$doctor->user->name}}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">

                    <div class="shadow border rounded p-4 mb-5">
                        <h2 class="text-primary">Personal Information</h2>
                        <hr>
                        <span class="fs-6 fw-bold">Name:&ensp;&ensp;</span><span class="fs-6">{{$doctor->user->name}}</span> <hr>
                        <span class="fs-6 fw-bold">Email: &ensp;&ensp; </span><span class="fs-6">{{$doctor->user->email}}</span><hr>
                        <span class="fs-6 fw-bold">National_Id: &ensp;&ensp; </span><span class="fs-6">{{$doctor->user->national_id}}</span>

                    </div>

                    <div class="shadow border rounded p-5 mb-5">
                        <h2 class="text-primary">More Details</h2>
                        <p>Work in {{$doctor->pharmacy->name}} pharmacy</p>

                    </div>
                    </div>
                </div>
        </div>

    </section>

    @endsection
