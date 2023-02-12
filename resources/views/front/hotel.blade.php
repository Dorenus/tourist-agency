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
                        <div class="col-12">
                            <div class="list-table one">
                                <div class="top">
                                    <h3>
                                        {{$hotel->title}}
                                    </h3>
                                    <div class="smallimg">
                                        @if($hotel->photo)
                                        <img src="{{asset($hotel->photo)}}">
                                        @else
                                        <img src="{{asset('no.jpg')}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="bottom mt-4">
                                    <div class="info">
                                        <div class="type" style="font-size: 20px; font-weight:bold"> {{$hotel->hotelsCountry->title}}</div>
                                        <div class=" size" style="font-size: 16px; font-weight:bold"> {{$hotel->length}} days</div>
                                        <span>From: {{$hotel->hotelsCountry->start}} To: {{$hotel->hotelsCountry->end}}</span>

                                    </div>
                                    <div class="buy">
                                        <div class="price"> {{$hotel->price}} Eur</div>
                                        <form action="{{route('add-to-cart')}}" method="post">
                                            <button type="submit" class="btn btn-outline-primary">Add to cart</button>
                                            <input type="number" min="1" name="count" value="1">
                                            <input type="hidden" name="product" value="{{$hotel->id}}">
                                            @csrf
                                        </form>

                                        {{-- <button type="submit" class="btn btn-outline-primary">Add</button> --}}
                                    </div>

                                    {{-- @if(Auth::user()?->name) --}}
                                    {{-- @if(Auth::user()?->role == 'admin') --}}


                                    {{-- <form action="{{route('add-to-cart')}}" method="post">
                                    <button type="submit" class="btn btn-outline-primary">Add</button>
                                    <input type="number" min="1" name="count" value="1">
                                    <input type="hidden" name="product" value="{{$hotel->id}}">
                                    @csrf
                                    </form>
                                    @endif --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
