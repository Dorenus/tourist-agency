<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Country;
use App\Models\Order;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class FrontController extends Controller
{
    public function home(Country $country)
    {
        $hotels = Hotel::all();

        $hotels = $hotels->map(function($t) {
            $t->startNice = Carbon::parse($t->hotel_start)->format('Y.m.d');
            $t->endNice = Carbon::parse($t->hotel_end)->format('Y.m.d');
            // $t->startFront = Carbon::parse($t->start)->format(''F j, Y'');
            // $t->endFront = Carbon::parse($t->end)->format(''F j, Y'');
            return $t;
        });

        // $countries = Country::all()->sortBy('title');

        

        // $countries = $countries->map(function($t) {
        //     $t->startNice = Carbon::parse($t->start)->format('F j, Y');
        //     $t->endNice = Carbon::parse($t->end)->format('F j, Y');
        //     return $t;
        // });

        return view('front.home', [
            'hotels' => $hotels,
            // 'countries' => $countries
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

       public function addToCart(Request $request, CartService $cart)
    {
        $id = (int) $request->product;
        $count = (int) $request->count;
        $cart->add($id, $count);
        return redirect()->back()->with('ok', 'Reservation was added to cart');
    }

    public function cart(CartService $cart)
    {
        return view('front.cart', [
            'cartList' => $cart->list
        ]);
    }

    public function updateCart(Request $request, CartService $cart)
    {
       
        if ($request->delete) {
            $cart->delete($request->delete);
        } else {
        $updatedCart = array_combine($request->ids ?? [], $request->count ?? []);
        $cart->update($updatedCart);
        }
        return redirect()->back();
    }

    public function makeOrder(CartService $cart)
    {
        $order = new Order;

        $order->user_id = Auth::user()->id;

        $order->order_json = json_encode($cart->order());

        $order->save();

        $cart->empty();

        return redirect()->route('start')->with('ok', 'You have confirmed your order');
    }

}
 