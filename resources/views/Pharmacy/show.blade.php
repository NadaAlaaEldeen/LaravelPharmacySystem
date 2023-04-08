@extends('layouts.container')

@section('title') Show @endsection

@section('content')

<section class="container p-5">
    @role('pharmacy')
        <div class="d-flex justify-content-end mb-3">
            <a href="{{route('pharmacies.edit', $pharmacy['id'])}}" class="btn btn-primary d-flex justify-content-end">Edit</a>
        </div>
    @endrole
    <div class="card mb-3">
            <div class="card-header fs-4">
                Pharmacy Owner Info
            </div>
            <div class="card-body">
                <h5 class="fs-4">
                    @if ($pharmacy->user->avatar)
                        <img src="{{asset('storage/'.$pharmacy->user->avatar)}}" style=" border-radius: 50%;" height="50vh"/>
                    @endif
                    <span>{{$pharmacy->user->name}}</span>
                    <span class="fs-5">({{$pharmacy->user->gender}})</span>
                    
                </h5>
                <p class="fs-5">Email: {{$pharmacy->user->email}}</p>
                <p class="fs-5">Phone: {{$pharmacy->user->mobile}}</p>
                <p class="fs-5">National_ID: {{$pharmacy->user->national_id}}</p>
                <p class="fs-5">BirthDay: {{$pharmacy->user->birth_day}}</p>
            </div>
    </div>

    <div class="card mb-3">
            <div class="card-header fs-4">
                Pharmacy Info
            </div>
            <div class="card-body">
                <h5>
                    <span>Name: {{$pharmacy->name}}</span>
                </h5>
                <p class="fs-5">Area: {{$pharmacy->area->name}}</p>
            </div>
    </div>

</section>

@endsection
