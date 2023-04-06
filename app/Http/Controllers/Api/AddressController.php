<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\AddressResource;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
     public function index()
    {
        // $user = User::find(1);
        // Auth::login($user);
        $userAddresses = Address::with('area')->where('user_id', Auth::id())->get();
        return AddressResource::collection($userAddresses);
    }

    public function create(Request $request)
    {
        if ($request['is_main']) {
            $userAddresses = Address::where('user_id', Auth::id())->get();
            foreach ($userAddresses as $address) {
                $address->is_main = 0;
                $address->update();
            }
        }
        $address = Address::create([
            'user_id' => Auth::id(),
            'area_id' => $request['area_id'],
            'street_name' => $request['street_name'],
            'building_number' => $request['building_number'],
            'floor_number' => $request['floor_number'],
            'flat_number' => $request['flat_number'],
            'is_main' => $request['is_main'],
        ]);

        $success['message'] = 'create done successfully';
        return response()->json([
            'success' => $success,
            'Data' => new AddressResource($address)
        ], 201);
    }

    public function update($id, Request $request)
    {
        if ($request['is_main']) {
            $userAddresses = Address::where('user_id', Auth::id())->get();
            foreach ($userAddresses as $address) {
                $address->is_main = 0;
                $address->update();
            }
        }

        $address = Address::find($id);
        $address->update([
            'area_id' => $request['area_id'],
            'street_name' => $request['street_name'],
            'building_number' => $request['building_number'],
            'floor_number' => $request['floor_number'],
            'flat_number' => $request['flat_number'],
            'is_main' => $request['is_main'],
        ]);
        //return response()->json('updated');
        return view('address.index')->with('success', 'A Address is Updated Successfully!');
    }

    public function destroy($id)
    {
        $address = Address::find($id);
        $address->delete();
        return response()->json('deleted successfully');
    }
}
