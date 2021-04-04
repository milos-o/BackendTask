<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LocationPostRequest;
use App\Models\Location;

class LocationController extends Controller
{
    public function allLocations(){
        $locations  = Location::all();

        return response()->json([
            "status" => "success",
            "locations" => $locations
        ],200);
    }

    public function getSingleLocation(Request $request){
        $location = Location::findOrFail($request->id);

        return response()->json([
            "status" => "success",
            "location" => $location
        ],200);
    }

    public function addLocation(LocationPostRequest $request){

        Location::create([
            'city' => $request['city'],
            'state' => $request['state'],
            'country' => $request['country'],
            'adress' => $request['adress'],
            'zipcode' => $request['zipcode'],
            'hotel_id' => $request['hotel_id']
        ]);

        return response()->json(["status" => "success"], 200);
    }

    public function changelocation(LocationPostRequest $request){
        $location = Location::findOrFail($request->id);
        $location->city = $request->city;
        $location->state = $request->state;
        $location->country = $request->country;
        $location->adress = $request->adress;
        $location->zipcode = $request->zipcode;
        $location->save();
        return response()->json(["status" => "success"],200);
    }


    public function destroy($id){
        $location = Location::findOrFail($id);
        $location->delete();
        return response()->json(["status" => "success"],200);
    }
}
