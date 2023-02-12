@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            @include('front.common.cats')
        </div>
        <div class="col-9">
            <div class="card-body">
                <div class="container">
                    <div class="row justify-content-center">

                        @forelse($hotels as $hotel)
                        <div class="col-4">
                            <div class="list-table text-center">
                                <h3>
                                    {{$hotel->title}}
                                </h3>
                                <a href="{{route('show-hotel', $hotel)}}">

                                    <div class="smallimg">
                                        @if($hotel->photo)
                                        <img src="{{asset($hotel->photo)}}">
                                        @else
                                        <img src="{{asset('no.jpg')}}">
                                        @endif
                                    </div>
                                </a>

                                <div class="size mt-2" style="font-style:italic; font-size:16px; font-weight:bold"> {{$hotel->length}} days</div>

                                <div class="price"> {{$hotel->price}} Eur</div>
                                <div class="type" style="font-weight:bold; font-size:16px"> {{$hotel->hotelsCountry->title}}</div>
                                <div class="type">From: {{$hotel->hotelsCountry->start}}</div>
                                <div class="type">To: {{$hotel->hotelsCountry->end}}</div>
                                {{-- {{dd($hotel->hotelsCountry)}} --}}


                                {{-- <span>From: {{$hotel->hotelsCountry->start}} To: {{$hotel->hotelsCountry->end}}</span> --}}


                                @if(Auth::user()?->name)
                                {{-- @if(Auth::user()?->role == 'admin') --}}


                                <form action="{{route('add-to-cart')}}" method="post">
                                    <button type="submit" class="btn btn-outline-primary">Add</button>
                                    <input type="number" min="1" name="count" value="1">
                                    <input type="hidden" name="product" value="{{$hotel->id}}">
                                    @csrf
                                </form>
                                @endif




                            </div>

                        </div>
                        @empty
                        No hotels yet
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-light py-3 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p class="text-muted">
                        &copy; 2023 Oriental Travel Agency - All rights reserved
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <ul class="list-unstyled text-secondary">
                        <li>
                            <i class="fas fa-map-marker-alt mr-2 text-primary"></i>
                            123 Main Street, Anytown, USA
                        </li>
                        <li>
                            <i class="fas fa-phone mr-2 text-primary"></i>
                            (123) 456-7890
                        </li>
                        <li>
                            <i class="fas fa-envelope mr-2 text-primary"></i>
                            info@travelagency.com
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="#">
                            <i class="fab fa-facebook-square fa-2x mx-3 text-primary"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter-square fa-2x mx-3 text-primary"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-instagram fa-2x mx-3 text-primary"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-viber fa-2x mx-3 text-primary"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-telegram fa-2x mx-3 text-primary"></i>

                    </div>
                </div>
            </div>
        </div>
    </footer>




</div>
@endsection
