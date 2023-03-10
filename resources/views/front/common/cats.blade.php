@inject('cats', 'App\Services\CatsService')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a style="text-decoration:none; color:black;" href="{{ url('/') }}">

                        <h2 class="text-center">All countries</h2>
                    </a>

                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($cats->get() as $country)
                        <li class="list-group-item">
                            <div class="list-table cats">
                                <div class="list-table__content">
                                    <a href="{{route('show-cats-hotels', $country)}}">
                                        <h3>
                                            {{$country->title}}
                                            <div class="count">[{{$country->countryHotels()->count()}}]</div>
                                        </h3>
                                    </a>
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
