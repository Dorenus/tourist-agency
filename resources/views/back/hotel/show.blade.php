@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Show Hotel</h1>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight:bold">Hotel name: </label>

                                    {{$hotel->title}}
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight:bold">Country: </label>

                                    {{$hotel->hotelsCountry?->title}}
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight:bold">Vocation length: </label>

                                    {{$hotel->length}} days
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight:bold">Vocation start and end: </label>

                                    From {{$hotel->hotel_start}} to {{$hotel->hotel_end}}

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight:bold">Hotel price: </label>

                                    {{$hotel->price}} Eur
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight:bold">Hotel description: </label>
                                    <div>
                                        {{$hotel->desc}}
                                    </div>
                                </div>
                            </div>


                            {{-- @if($hotel->vol)
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Drink VOL</label>
                                    {{$hotel->vol}} %
                        </div>
                    </div>
                    @endif --}}

                    {{-- <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Drink description</label>
                                    <div>
                                        {{$hotel->desc}}
                </div>
            </div>
        </div> --}}

        @if($hotel->photo)
        <div class="col-12">
            <div class="mb-3 img">
                <img src="{{asset($hotel->photo)}}">
            </div>
        </div>
        @endif
    </div>
</div>
<a href="{{route('hotels-pdf', $hotel)}}" class="btn btn-outline-primary">Download PDF</a>
</div>
</div>
</div>
</div>
</div>
@endsection
