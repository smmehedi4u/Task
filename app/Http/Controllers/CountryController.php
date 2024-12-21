<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function store(Request $request)
    {
        $countryData = [
            'name' => $request->name
        ];
        Country::create($countryData);
        return response()->json([
            'status' => 200,
        ]);
    }
    public function getall()
    {
        $countries = Country::all();
        return response()->json([
            'status' => 200,
            'countries' => $countries
        ]);
    }
    public function edit($id)
    {
        $country = Country::find($id);
        if ($country) {
            return response()->json([
                'status' => 200,
                'country' => $country
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Country not found'
            ]);
        }
    }
    public function update(Request $request)
    {
        $country = Country::find($request->id);
        if ($country) {
            $country->name = $request->name;
            $country->save();
            return response()->json([
                'status' => 200,
                'message' => 'Country updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Country not found'
            ]);
        }
    }
    public function delete(Request $request)
    {
        $country = Country::find($request->id);
        if ($country && $country->delete()) {
            return response()->json(['status' => 200, 'message' => 'Country deleted successfully.']);
        } else {
            return response()->json(['status' => 400, 'message' => 'Failed to delete country.']);
        }
    }
}

