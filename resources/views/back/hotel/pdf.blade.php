<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$hotel->title}}</title>
    <style>
        .mb-3 {
            margin: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .img img {
            height: 400px;
            width: auto;
        }

    </style>
</head>
<body>
    <h1>{{$hotel->title}}</h1>
    <div class="mb-3">
        <label class="form-label">Country</label>
        {{$hotel->hotelsCountry?->title}}
    </div>
    <div class="mb-3">
        <label class="form-label">Vocation length</label>
        {{$hotel->length}} days
    </div>
    <div class="mb-3">
        <label class="form-label">Hotel price</label>
        {{$hotel->price}} Eur
    </div>
    {{-- @if($hotel->vol)
    <div class="mb-3">
        <label class="form-label">Drink VOL</label>
        {{$hotel->vol}} %
    </div>
    @endif --}}
    <div class="mb-3">
        <label class="form-label">Hotel description</label>
        <div>
            {{$hotel->desc}}
        </div>
    </div>
    @if($hotel->photo)
    <div class="mb-3 img">
        <img src="{{asset($hotel->photo)}}">
    </div>
    @endif
</body>
</html>
