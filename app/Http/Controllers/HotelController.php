<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HotelPostRequest;
use App\Models\Hotel;
use App\Models\Location;

use Illuminate\Support\Str;

class HotelController extends Controller
{
    //
    public function allHotels(){
        $hotels = Hotel::with('location')->get();

        return response()->json([
            "status" => "success",
            "hotels" => $hotels
        ],200);
    }

    public function getSingleHotel(Request $request){
        $hotel = Hotel::findOrFail($request->id);

        return response()->json([
            "status" => "success",
            "hotel" => $hotel
        ],200);
    }

    public function addHotel(HotelPostRequest $request){

        $path = url("/hotel.png");

        if($request->hasFile('image')){
            $path = $request->image->store('images', 'public');
        }
       
        

       $name = $request['name'];
       $contains = Str::contains($name, ['Book', 'Offer', 'Free', 'Website']);

       if($contains){
        return response()->json(["validation" => "failed"], 422);
       }

        $reputation = $request['reputation'];

        if($reputation <= 500){
            $reputationBadge = "Red";
        }else if($reputation <= 799){
            $reputationBadge = "Yellow";
        }else{
            $reputationBadge = "Green";
        }

        $category = $request['category'];
        if($category != 'hotel' && $category !== 'alternative' && $category !== 'hostel' && $category !== 'lodge' && $category !== 'resort' && $category !== 'guest-house'){
            return response()->json(["validation" => "failed"], 422);
        }

       
        Hotel::create([
            'name' => $name,
            'rating' => $request['rating'],
            'category' => $category,
            'reputationBadge' => $reputationBadge,
            'reputation' => $reputation,
            'image' => $path,
            'price' => $request['price'],
            'availability' => $request['availability']
        ]);

        return response()->json(["status" => "success"], 200);
    }

    public function changeHotel(HotelPostRequest $request){
        $hotel = Hotel::findOrFail($request->id);


        $path = $hotel->image;

        if($request->hasFile('image')){
            $path = $request->image->store('images', 'public');
        }
       

        $name = $request['name'];
        $contains = Str::contains($name, ['Book', 'Offer', 'Free', 'Website']);
 
        if($contains){
         return response()->json(["validation" => "failed"], 422);
        }
 
         $reputation = $request['reputation'];
 
         if($reputation <= 500){
             $reputationBadge = "Red";
         }else if($reputation <= 799){
             $reputationBadge = "Yellow";
         }else{
             $reputationBadge = "Green";
         }
 
         $category = $request['category'];
         if($category != 'hotel' && $category !== 'alternative' && $category !== 'hostel' && $category !== 'lodge' && $category !== 'resort' && $category !== 'guest-house'){
             return response()->json(["validation" => "failed"], 422);
         }

        $hotel->name = $name;
        $hotel->rating = $request->rating;
        $hotel->category = $category;
        $hotel->reputationBadge = $reputationBadge;
        $hotel->reputation = $request->reputation;
        $hotel->price = $request->price;
        $hotel->image = $path;
        $hotel->availability = $request->availability;
        $hotel->save();
        return response()->json(["status" => "success"],200);
    }


    public function destroy($id){
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        return response()->json(["status" => "success"],200);
    }

    public function getRatedHotel(Request $request){
        $hotels = Hotel::with('location')
                  ->where('rating', $request->rating)
                  ->get();

        return response()->json([
            "status" => "success",
            "hotels" => $hotels
        ],200);
    }

    public function getHotelInLocation(Request $request){

        $city = Location::where('city', $request->location)->first();
        
        $hotels = Hotel::with('location')
                  ->where('id', $city->hotel_id)
                  ->get();

        return response()->json([
            "status" => "success",
            "hotels" => $hotels
        ],200);
    }

    public function getHotelsWithReputationBadge(Request $request){
    
        $hotels = Hotel::with('location')
                  ->where('reputationBadge', $request->badge)
                  ->get();

        return response()->json([
            "status" => "success",
            "hotels" => $hotels
        ],200);
    }

    public function getHotelsWithCategory(Request $request){
    
        $hotels = Hotel::with('location')
                  ->where('category', $request->category)
                  ->get();

        return response()->json([
            "status" => "success",
            "hotels" => $hotels
        ],200);
    }

    public function getHotelsWithAvailability(Request $request){
    
        $hotels = Hotel::with('location')
                  ->where('availability', '>=', $request->availability)
                  ->get();

        return response()->json([
            "status" => "success",
            "hotels" => $hotels
        ],200);
    }

    
}
