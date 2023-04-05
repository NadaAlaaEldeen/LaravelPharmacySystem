@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<!-- <section class="container p-5">
    <div class="card mb-3">
            <div class="card-header">
                Post Info
            </div>
            <div class="card-body">
            <h5 class="card-title fs-4">Title: {{$post->name}}</h5>

                <span class="card-title fs-4">Description: </span><span class="fs-5">{{$post->email}}</span></br>
            </div>
    </div>


</section> -->


<section>

        <!-- .container start -->
        <div class="container py-5">

            <!-- .row start -->
            <div class="row">

                <!-- .col start -->
                <div class="col-lg-4">

                    <div class="card text-center p-5 shadow border rounded">

                        <div class="card-body">

                            <img src="{{$post->avatar}}" alt="Profil Picture" class="img img-thumbnail  w-60">
                            <br><br>
                            <h2>Dr: {{$post->name}}</h2>


                        </div>

                    </div>

                </div>
                <!-- .col end -->

                <!-- .col start -->
                <div class="col-lg-8">

                    <div class="shadow border rounded p-4 mb-5">
                        <h2>Personal Information</h2>
                        <hr>
                        <span class="fs-6 fw-bold">Name:&ensp;&ensp;</span><span class="fs-6">{{$post->name}}</span> <hr>
                        <span class="fs-6 fw-bold">Email: &ensp;&ensp; </span><span class="fs-6">{{$post->email}}</span><hr>
                        <span class="fs-6 fw-bold">Phone: &ensp;&ensp; </span><span class="fs-6">{{$post->mobile}}</span>

                    </div>

                    <div class="shadow border rounded p-5 mb-5">
                        <h2>More Details</h2>
                        <p>He lives in Alex.he started to work in {{$post->pharmacy_id}} at
                            <span class="d-block">{{$post->created_at}}</span>

                                    <!-- <span class="text-muted mb-1 d-block">Alamat :</span> -->
                    </div>
                    </div>
                </div>
        </div>
        <!-- .container end -->

    </section>

@endsection
