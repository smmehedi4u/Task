<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('state', compact('countries'));
    }
    public function store(Request $request)
    {
        $stateData = [
            'name' => $request->name,
            'country_id' => $request->country_id
        ];
        State::create($stateData);
        return response()->json([
            'status' => 200,
        ]);
    }
    public function getall()
    {
        $states = State::with('country')->get();
        return response()->json([
            'status' => 200,
            'states' => $states
        ]);
    }
    public function edit($id)
    {
        $state = State::findOrFail($id);
        $countries = Country::all();
        return view('state', compact('state', 'countries'));

        if ($state) {
            return response()->json([
                'status' => 200,
                'state' => $state
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
        $state = State::find($request->id);
        if ($state) {
            $state->name = $request->name;
            $state->country_id = $request->country_id;
            $state->save();
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
        $state = State::find($request->id);
        if ($state && $state->delete()) {
            return response()->json(['status' => 200, 'message' => 'State deleted successfully.']);
        } else {
            return response()->json(['status' => 400, 'message' => 'Failed to delete state.']);
        }
    }
}

