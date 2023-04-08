@extends('layouts.container')

@section('title') Show @endsection

@section('content')

<section class="container p-5">
    <div class="card mb-3">
            <div class="card-header fs-4">
                Client Info
            </div>
            <div class="card-body">
                <h5 class="fs-4">
                    @if ($client->user->avatar)
                        <img src="{{asset('storage/'.$client->user->avatar)}}" style=" border-radius: 50%;" height="50vh"/>
                    @endif
                    <span>{{$client->user->name}}</span>
                    <span class="fs-5">({{$client->user->gender}})</span>
                    
                </h5>
                <p class="fs-5">Email: {{$client->user->email}}</p>
                <p class="fs-5">Phone: {{$client->user->mobile}}</p>
                <p class="fs-5">National_ID: {{$client->user->national_id}}</p>
                <p class="fs-5">BirthDay: {{$client->user->birth_day}}</p>
                <p class="fs-5">Is_Inquired: {{$client->is_inquired}}</p>
            </div>
    </div>

    

</section>

@endsection
