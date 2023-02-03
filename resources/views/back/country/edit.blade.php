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
@endsection
