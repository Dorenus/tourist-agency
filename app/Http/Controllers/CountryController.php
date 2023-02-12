<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all()->sortBy('title');

        

        $countries = $countries->map(function($t) {
            $t->startNice = Carbon::parse($t->start)->format('F j, Y');
            $t->endNice = Carbon::parse($t->end)->format('F j, Y');
            return $t;
        });

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
        
        //  $validator = Validator::make(
        //     $request->all(),
        //     [
        //     'title' => 'required|min:4|max:100',
        //     'season' => 'required|min:5|max:100',
        //     ]);

        //     if ($validator->fails()) {
        //         $request->flash();
        //         return redirect()->back()->withErrors($validator);
        //     }



        $country = new Country;
        $country->title = $request->title;
        $country->season = $request->season;

        
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->start)->addDays($request->length);
        
        // $country = $country->map(function($t) {
        //     $t->startNice = Carbon::parse($t->start)->format('F j, Y');
        //     $t->endNice = Carbon::parse($t->end)->format('F j, Y');
        //     return $t;
        // });

        Country::insert([
            'title' => $request->title,
            'season' => $request->season,
            'start' => $start,
            'end' => $end,
        ]);

        // $country->save();

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

        // $start = Carbon::parse($request->start);
        // $end = Carbon::parse($request->start)->addDays($request->length);

        // Country::insert([
        //     'title' => $request->title,
        //     'season' => $request->season,
        //     'start' => $start,
        //     'end' => $end,
        // ]);
        // $country->startNice = $start;
        // $country->startNice = $end;
        $country->title = $request->title;
        $country->season = $request->season;
        $country->save();

        return redirect()->route('countries-index')->with('ok', 'Country was edited');
    }

    public function destroy(Country $country)
    {


        if (!$country->countryHotels()->count()) {
            $country->delete();
            return redirect()->route('countries-index')->with('ok', 'Country was deleted');
        }
        return redirect()->back()->with('not', 'Country has hotels.');
    }
}



