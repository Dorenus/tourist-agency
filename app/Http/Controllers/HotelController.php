<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Intervention\Image\ImageManager;


class HotelController extends Controller

{


    public function index(Request $request)
    {
         
        if (!$request->s) {

        if ($request->country_id && $request->country_id != 'all') {
                $hotels = Hotel::where('country_id', $request->country_id);
            }
            else {
                $hotels = Hotel::where('id', '>', 0);
            } 

        $hotels = match($request->sort ?? '') {
                'asc_title' => $hotels->orderBy('title'),
                'desc_title' => $hotels->orderBy('title', 'desc'),
                'asc_price' => $hotels->orderBy('price'),
                'desc_price' => $hotels->orderBy('price', 'desc'),
                'asc_length' => $hotels->orderBy('length'),
                'desc_length' => $hotels->orderBy('length', 'desc'),
                default => $hotels
            };
            $hotels = $hotels->get();
        }
        
            // $hotels = $hotels->get();

         else {
             $s = explode(' ', $request->s);
             if ( count($s) == 1) {
                $hotels = Hotel::where('title', 'like', '%'.$request->s.'%')->get();
            }
            else {
                $hotels = Hotel::where('title', 'like', '%'.$s[0].'%'.$s[1].'%')
                ->orWhere('title', 'like', '%'.$s[1].'%'.$s[0].'%')
                ->get();
            }
        
        }


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

        $countries = Country::all()->sortBy('title');


        return view('back.hotel.index', [
            'hotels' => $hotels,
            'sortSelect' => Hotel::SORT,
            'sortShow' => isset(Hotel::SORT[$request->sort]) ? $request->sort : '',
            // 'perPageSelect' => Drink::PER_PAGE,
            // 'perPageShow' => $perPageShow,
            'countries' => $countries,
            'countryShow' => $request->country_id ? $request->country_id : '',
            's' => $request->s ?? ''
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
            

            // $manager = new ImageManager(['driver' => 'GD']);

            // $image = $manager->make($photo);
            // $image->crop(400, 600);
            // $image->save(public_path().'/hotels/'.$file);


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
        $hotel->desc = $request->hotel_desc;
        // $hotel->photo = $request->photo;

        $hotel->save();

        return redirect()->route('hotels-index')->with('ok', 'New hotel was added');

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
        
        if ($request->delete_photo) {
            $hotel->deletePhoto();
            return redirect()->back()->with('ok', 'Photo was deleted');
        }
       
         
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
        // if ($request->file('photo')) {
        //     $photo = $request->file('photo');

        //     $ext = $photo->getClientOriginalExtension();
        //     $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
        //     $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            
        //     // $Image = Image::make($photo)->pixelate(12);
        //     // $Image->save(public_path().'/trucks/'.$file);

        //     if ($hotel->photo) {
        //         $hotel->deletePhoto();
        //     }
        //     $photo->move(public_path().'/drinks', $file);
        //     $hotel->photo = '/drinks/' . $file;
        // }

        
        $hotel->title = $request->title;
        $hotel->country_id = $request->country_id;
        $hotel->length = $request->length;
        $hotel->price = $request->price;
        // $hotel->photo = $request->photo;
        $hotel->desc = $request->hotel_desc;
     

        $hotel->save();

        return redirect()->route('hotels-index')->with('ok', 'Hotel was edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drink  $hotel
     * @return \Illuminate\Http\Response
     */

    public function show(Hotel $hotel)
    {
        return view('back.hotel.show', ['hotel' => $hotel]);
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->back()->with('not', 'Hotel was deleted');
    }

    public function pdf(Hotel $hotel)
    {
        $pdf = Pdf::loadView('back.hotel.pdf', ['hotel' => $hotel]);
        return $pdf->download($hotel->title.'.pdf');
    }
}
