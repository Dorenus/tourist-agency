<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller

{


    public function index(Request $request)
    {
 

        $hotels = match($request->sort ?? '') {
                'asc_title' => Hotel::orderBy('title'),
                'desc_title' => Hotel::orderBy('title', 'desc'),
                'asc_price' => Hotel::orderBy('price'),
                'desc_price' => Hotel::orderBy('price', 'desc'),
                'asc_length' => Hotel::orderBy('length'),
                'desc_length' => Hotel::orderBy('length', 'desc'),
                default => Hotel::where('id', '>', 0)
            };
        
            $hotels = $hotels->get();



        //  $hotels= Hotel::all();

        //  $hotels = match($request->sort ?? '') {
        //         'asc_title' => $hotels->orderBy('title'),
        //         'desc_title' => $hotels->orderBy('title', 'desc'),
        //         'asc_price' => $hotels->orderBy('price'),
        //         'desc_price' => $hotels->orderBy('size', 'desc'),
        //         default => $hotels
        //     };
        
        // $hotels = $hotels->get();


        // $hotels = Hotel::all()->sortBy('title');
        // $hotels = Hotel::all();


        return view('back.hotel.index', [
            'hotels' => $hotels,
            'sortSelect' => Hotel::SORT,
            'sortShow' => isset(Hotel::SORT[$request->sort]) ? $request->sort : '',
            // 'perPageSelect' => Drink::PER_PAGE,
            // 'perPageShow' => $perPageShow,
            // 'types' => $types,
            // 'typeShow' => $request->type_id ? $request->type_id : '',
            // 's' => $request->s ?? ''
        ]);

    }

    public function create()
    {

       $countries = Country::all()->sortBy('title');

       return view('back.hotel.create', [
           'countries' => $countries
       ]);

    }


    public function store(Request $request)
    {

        
        $validator = Validator::make(
            $request->all(),
            [
            'title' => 'required|alpha|min:3|max:100|',
            'length' => 'required|numeric|min:1|max:9999',
            'price' => 'required|decimal:0,2|min:0|max:99999',
            // 'country_id' => 'required|alpha|min:3|max:100|',
            // 'country_id' => 'required|numeric|min:1',
            // 'drink_vol' => 'sometimes|decimal:0,1|min:1|max:99',
            ]);

            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        
        $hotel = new Hotel;


        if ($request->file('photo')) {
            $photo = $request->file('photo');

            // dd($photo);

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            
            // $Image = Image::make($photo)->pixelate(12);
            // $Image->save(public_path().'/trucks/'.$file);

            $photo->move(public_path().'/hotels', $file);

            $hotel->photo = '/hotels/' . $file;

            // $hotel->photo = asset('/hotels/') . '/' . $file;

            // $hotel->photo = "any text";

        }

    

        // $type = Type::find($request->type_id);
        // $vol = $type->is_alk ? $request->drink_vol : null;

        $hotel->title = $request->title;
        $hotel->country_id = $request->country_id;
        $hotel->length = $request->length;
        $hotel->price = $request->price;
        // $hotel->photo = $request->photo;

        $hotel->save();

        return redirect()->route('hotels-index')->with('okh', 'New hotel was added');

    }



    public function edit(Hotel $hotel)
    {
        
        $countries = Country::all()->sortBy('title');

        // $alkIds = json_encode($types->filter(fn($t) => $t->is_alk)->pluck('id')->all());

        return view('back.hotel.edit', [
            'hotel' => $hotel,
            'countries' => $countries,
            
        ]);
    }



     public function update(Request $request, Hotel $hotel)
    {
        
        // if ($request->delete_photo) {
        //     $drink->deletePhoto();
        //     return redirect()->back()->with('ok', 'Photo was deleted');
        // }
       
        
            $validator = Validator::make(
            $request->all(),
            [
            'title' => 'required|alpha|min:3|max:100|',
            'length' => 'required|numeric|min:1|max:9999',
            'price' => 'required|decimal:0,2|min:0|max:99999',
            // 'country_id' => 'required|alpha|min:3|max:100|',
            // 'country_id' => 'required|numeric|min:1',
            // 'drink_vol' => 'sometimes|decimal:0,1|min:1|max:99',
            ]);

            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        // $type = Type::find($request->type_id);
        // $vol = $type->is_alk ? $request->drink_vol : null;

        // if ($request->file('photo')) {
        //     $photo = $request->file('photo');

        //     $ext = $photo->getClientOriginalExtension();
        //     $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
        //     $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            
        //     // $Image = Image::make($photo)->pixelate(12);
        //     // $Image->save(public_path().'/trucks/'.$file);

        //     if ($drink->photo) {
        //         $drink->deletePhoto();
        //     }
        //     $photo->move(public_path().'/drinks', $file);
        //     $drink->photo = '/drinks/' . $file;
        // }

        
        $hotel->title = $request->title;
        $hotel->country_id = $request->country_id;
        $hotel->length = $request->length;
        $hotel->price = $request->price;
        $hotel->photo = $request->photo;
     

        $hotel->save();

        return redirect()->route('hotels-index')->with('edith', 'Hotel was edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->back()->with('delh', 'Hotel was deleted');
    }
}
