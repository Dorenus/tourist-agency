@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>All Countries</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($countries as $country)
                        <li class="list-group-item">
                            <div class="list-table">
                                <div class="list-table__content">
                                    <div class="count">[{{$country->countryHotels()->count()}}]</div>
                                    <h3>{{$country->title}}</h3>
                                    <h3>{{$country->season}}</h3>

                                    <span>From: {{$country->startNice}} To: {{$country->endNice}}</span>





                                </div>
                                <div class="list-table__buttons">
                                    {{-- @if(Auth::user()?->role == 'admin') --}}
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
