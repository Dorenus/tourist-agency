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

                                <div class="size"> {{$hotel->length}} days</div>
                                <div class="price"> {{$hotel->price}} Eur</div>
                                <div class="type"> {{$hotel->hotelsCountry->title}}</div>

                                <form action="{{route('add-to-cart')}}" method="post">
                                    <button type="submit" class="btn btn-outline-primary">Add</button>
                                    <input type="number" min="1" name="count" value="1">
                                    <input type="hidden" name="product" value="{{$hotel->id}}">
                                    @csrf
                                </form>




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
</div>
@endsection
