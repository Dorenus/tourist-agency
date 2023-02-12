{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Edit country</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('countries-update', $country)}}" method="post">
<div class="mb-3">
    <label class="form-label">Country name</label>
    <input type="text" class="form-control" name="title" value="{{$country->title}}">
</div>
<div class="mb-3">
    <label class="form-label">Season name</label>
    <input type="text" class="form-control" name="season" value="{{$country->season}}">
</div>

<button type="submit" class="btn btn-outline-primary mt-4">Save</button>
@csrf
@method('put')
</form>
</div>
</div>
</div>
</div>
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Edit country</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('countries-update', $country)}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Country name</label>
                            <input type="text" class="form-control" name="title" value="{{old('title', $country->title)}}">
                        </div>
                        <div class="mb-3">


                            {{-- <div class="mb-3">
                                <label class="form-label">Season Start</label>
                                <input type="date" class="form-control" name="start">

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Season length</label>
                                <input type="text" class="form-control" name="length">

                            </div> --}}


                            <label class="form-label">Season name</label>
                            {{-- <input type="text" class="form-control" name="season" value="{{$country->season}}">
                        </div> --}}

                        <select class="form-control" name="season" value="{{$country->season}}">

                            <option>Spring</option>
                            <option>Summer</option>
                            <option>Autumn</option>
                            <option>Winter</option>
                        </select>




                        <button type="submit" class="btn btn-outline-primary mt-4">Save</button>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
