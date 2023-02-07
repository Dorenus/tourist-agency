<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Country;


class FrontController extends Controller
{
    public function home()
    {
        $hotels = Hotel::all();

        return view('front.home', [
            'hotels' => $hotels
        ]);
    }

     public function showHotel(Hotel $hotel)
    {
        return view('front.hotel', [
            'hotel' => $hotel
        ]);
    }

    public function showCatHotels(Country $country)
    {
        $hotels = Hotel::where('country_id', $country->id)->paginate(21);

        return view('front.home', [
            'hotels' => $hotels
        ]);
    }
}
 