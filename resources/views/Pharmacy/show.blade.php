@extends('layouts.app')

@section('title') Show @endsection

@section('content')


<section>

        <!-- .container start -->
        <div class="container py-5">

            <!-- .row start -->
            <div class="row">

                <!-- .col start -->
                <div class="col-lg-4">

                    <div class="card text-center p-5 shadow border rounded">

                        <div class="card-body">

                            <img src="{{$pharmacy->avatar}}" alt="Profil Picture" class="img img-thumbnail  w-60">
                            <br><br>
                            <h2>Dr: {{$pharmacy->name}}</h2>


                        </div>

                    </div>

                </div>
                <!-- .col end -->

                <!-- .col start -->
                <div class="col-lg-8">

                    <div class="shadow border rounded p-4 mb-5">
                        <h2 class="text-primary">Personal Information</h2>
                        <br>
                        <span class="fs-6 fw-bold">Name:&ensp;&ensp;</span><span class="fs-6">{{$pharmacy->name}}</span> <hr>
                        <span class="fs-6 fw-bold">Email: &ensp;&ensp; </span><span class="fs-6">{{$pharmacy->email}}</span><hr>
                        <span class="fs-6 fw-bold">Phone: &ensp;&ensp; </span><span class="fs-6">{{$pharmacy->mobile}}</span>

                    </div>

                    <div class="shadow border rounded p-5 mb-5">
                        <h2 class="text-primary">More Details</h2>
                        <p>He lives in Alex.he started to work in {{$pharmacy->name}} at
                            <span class="d-block">{{$pharmacy->created_at}}</span>

                                    <!-- <span class="text-muted mb-1 d-block">Alamat :</span> -->
                    </div>
                    </div>
                </div>
        </div>
        <!-- .container end -->

    </section>

@endsection
