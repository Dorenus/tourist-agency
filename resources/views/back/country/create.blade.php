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


                        <div class="mb-3">
                            <label class="form-label">Country name</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Season name </label>
                            <input type="text" class="form-control" name="season">
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
