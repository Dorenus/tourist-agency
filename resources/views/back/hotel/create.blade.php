@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Add new hotel</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('hotels-store')}}" method="post" enctype="multipart/form-data">
                        <div class="container">
                            <div class="row">

                                <div class="col-8">
                                    <div class="mb-3">
                                        <label class="form-label">Hotel name</label>
                                        <input type="text" class="form-control" name="title" value="{{old('title')}}">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Country of where hotel is located</label>
                                        <select id="drink--create--edit" class="form-select" name="country_id">
                                            @foreach($countries as $country)
                                            <option value="{{$country->id}}" @if($country->id == old('country_id')) selected @endif>{{$country->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Length</label>
                                        <input type="text" class="form-control" name="length" value="{{old('length')}}">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Vocation price</label>
                                        <input type="text" class="form-control" name="price" value="{{old('price')}}">
                                    </div>
                                </div>

                                {{-- {{-- <div class="col-3 drink-vol" id="drink--vol">
                                    <div class="mb-3">
                                        <label class="form-label">Drink VOL</label>
                                        <input type="text" class="form-control" name="drink_vol" value="{{old('drink_vol')}}">
                            </div>
                        </div> --}}

                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label">Hotel Photo</label>
                                <input type="file" class="form-control" name="photo">
                            </div>
                        </div>

                        <div class="col-9">
                            <div class="mb-3">
                                <label class="form-label">Hotel description</label>
                                <textarea class="form-control" rows="5" name="hotel_desc">{{old('hotel_desc')}}</textarea>
                            </div>
                        </div>
                </div>
            </div>

            <button type="submit" class="btn btn-outline-primary">Add New</button>
            @csrf
            </form>
        </div>
    </div>
</div>
</div>
</div>

@endsection
