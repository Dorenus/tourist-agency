@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Add country</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('countries-store')}}" method="post">
                        <div class="form-group">



                            <div class="mb-3">
                                <label class="form-label">Country name</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            {{-- <div class="mb-3">
                                <label class="form-label">Season name </label>
                                <input type="text" class="form-control" name="season">
                            </div> --}}

                            <div class="mb-3">
                                <label class="form-label">Season Start</label>
                                <input type="date" class="form-control" name="start">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Season length</label>
                                <input type="text" class="form-control" name="length">
                            </div>

                            <label class="form-label">Season name</label>

                            <select class="form-control" name="season">
                                <option>Spring</option>
                                <option>Summer</option>
                                <option>Autumn</option>
                                <option>Winter</option>
                            </select>


                            <button type="submit" class="btn btn-outline-primary mt-3">Add New</button>
                            @csrf
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
