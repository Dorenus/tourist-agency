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
                                <div class="bottom">
                                    <div class="info">
                                        <div class="type"> {{$hotel->hotelsCountry->title}}</div>
                                        <div class="size"> {{$hotel->length}} days</div>
                                        <span>From: {{$hotel->hotelsCountry->startNice}} To: {{$hotel->hotelsCountry->endNice}}</span>

                                    </div>
                                    <div class="buy">
                                        <div class="price"> {{$hotel->price}} Eur</div>
                                        <button type="submit" class="btn btn-outline-primary">Add</button>
                                    </div>
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
