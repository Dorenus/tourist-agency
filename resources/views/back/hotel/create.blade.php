@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Add hotel</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('hotels-store')}}" method="post">
                        <div class="form-group">



                            <div class="mb-3">
                                <label class="form-label">Country name</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hotel name </label>
                                <input type="text" class="form-control" name="season">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price </label>
                                <input type="text" class="form-control" name="season">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Photo </label>
                                <input type="text" class="form-control" name="season">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Length </label>
                                <input type="text" class="form-control" name="season">
                            </div>

                            {{-- <select class="form-control" name="season">
                                <option>Spring</option>
                                <option>Summer</option>
                                <option>Autumn</option>
                                <option>Winter</option>
                            </select> --}}


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
