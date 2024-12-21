<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $states = State::all();
        return view('city', compact('states'));
    }

    public function store(Request $request)
    {
        $cityData = [
            'name' => $request->name,
            'state_id' => $request->state_id
        ];
        City::create($cityData);
        return response()->json([
            'status' => 200,
        ]);
    }
    public function getall()
    {
        $cities = City::with('state')->get();
        return response()->json([
            'status' => 200,
            'cities' => $cities
        ]);
    }
    public function edit($id)
    {
        $city = City::find($id);
        if ($city) {
            return response()->json([
                'status' => 200,
                'city' => $city
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'State not found'
            ]);
        }
    }
    public function update(Request $request)
    {
        $city = City::find($request->id);
        if ($city) {
            $city->name = $request->name;
            $city->state_id = $request->state_id;
            $city->save();
            return response()->json([
                'status' => 200,
                'message' => 'State updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'State not found'
            ]);
        }
    }
    public function delete(Request $request)
    {
        $city = City::find($request->id);
        if ($city && $city->delete()) {
            return response()->json(['status' => 200, 'message' => 'City deleted successfully.']);
        } else {
            return response()->json(['status' => 400, 'message' => 'Failed to delete city.']);
        }
    }
}
