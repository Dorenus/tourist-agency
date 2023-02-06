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
        
         $validator = Validator::make(
            $request->all(),
            [
            'title' => 'required|min:4|max:100',
            'season' => 'required|min:5|max:100',
            ]);

            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }



        $country = new Country;
        $country->title = $request->title;
        $country->season = $request->season;
        $country->save();

        return redirect()->route('countries-index')->with('add', 'Country was added');
    }

    public function edit(Country $country)
    {
        return view('back.country.edit', [
            'country' => $country
        ]);
    }

    public function update(Request $request, Country $country)
    {
        
        $validator = Validator::make(
            $request->all(),
            [
            'title' => 'required|min:4|max:100',
            'season' => 'required|min:5|max:100',
            ]);

            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }



        $country->title = $request->title;
        $country->season = $request->season;
        $country->save();

        return redirect()->route('countries-index')->with('ok', 'Country was edited');
    }

    public function destroy(Country $country)
    {

        $country->delete();
        
        return redirect()->route('countries-index')->with('not', 'Country was deleted');
                // return redirect()->back()->with('not', 'Type has drinks.');
    }
}



