@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>All Hotels</h1>
                </div>
                <div>
                    <a href="{{route('hotels-store')}}"><button class="btn btn-outline-primary m-2 p-2">Add hotel</button></a>



                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($countries as $country)
                        <li class="list-group-item">
                            <div class="list-table">
                                <div class="list-table__content">
                                    <h3>{{$country->title}}</h3>
                                    <h5>{{$country->season}}</h5>

                                </div>
                                <div class="list-table__buttons">
                                    <a href="{{route('countries-edit', $country)}}" class="btn btn-outline-success">Edit</a>
                                    <form action="{{route('countries-delete', $country)}}" method="post">
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No countries yet</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
