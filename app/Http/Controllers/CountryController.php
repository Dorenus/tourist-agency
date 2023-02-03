<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all()->sortBy('title');
        return view('back.country.index', [
            'countries' => $countries
        ]);
    }

    public function create()
    {
       return view('back.country.create');

    }

    public function store(Request $request)
    {
        
        $country = new Country;
        $country->title = $request->title;
        $country->season = $request->season;
        $country->save();

        return redirect()->route('countries-index');
    }

    public function edit(Country $country)
    {
        return view('back.country.edit', [
            'country' => $country
        ]);
    }

    public function update(Request $request, Country $country)
    {
        
        $country->title = $request->title;
        $country->season = $request->season;
        $country->save();

        return redirect()->route('countries-index')->with('ok', 'Country was edited');
    }

    public function destroy(Country $country)
    {

        $country->delete();
        
        return redirect()->route('countries-index')->with('not', 'Country deleted');
                // return redirect()->back()->with('not', 'Type has drinks.');
    }
}



