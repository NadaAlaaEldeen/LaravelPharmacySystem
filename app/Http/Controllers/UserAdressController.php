<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use DataTables;

class UserAdressController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Address::select('id', 'street_name', 'building_number', 'area_id', 'user_id')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' .route("addresses.index").'" class="btn btn-success btn-sm mx-2">View</a>';
                    $btn .= '<a href="' .route("address.edit", $row->id).'" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="' .route("address.destroy", $row->id).'" class="btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })->addColumn('Name',function(Address $address){
                    return $address->user->name;
                })->addColumn('Address',function(Address $address){
                    return $address->area->name;
                })
                ->rawColumns(['action', 'Name', 'Address'])
                ->make(true);
        }
        return view('Address/index');
    }



    public function create()
    {
        //$doctors = Medicine::all();
         //dd($doctors);

        return view('address.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $address= Address::create([
            'street_name' => $request->street_name,
            'building_number' => $request->building_number,
            'floor_number' => $request->floor_number,
            'flat_number' => $request->flat_number,
            'is_main' => $request->is_main,
            'area_id' => $request->area_id,
            'user_id' => $request->user_id,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);

        return to_route('address');
    }

    // /**
    //  * Display the specified resource.
    //  */


    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit($address){
        //dd($user_id);
        //$users = User::all();
        $address = Address::find($address);
        //dd($address);
        return view('address.edit', ['address' => $address]);
    }
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $address){
        //dd($request);
        $address = Address::find($address);
        //$d = $request->name;
        //dd($d);

         $address->update(
            [
                //column name -> came data of name of input
                $address->street_name = $request->street_name,
                $address->building_number = $request->building_number,
                $address->floor_number = $request->floor_number,
                $address->is_main= $request->is_main,
                $address->flat_number= $request->flat_number,
                $address->area_id= $request->area_id
              ]);
        //dd($doctor->name);
         return view('address.create')->with('success', 'A Address is Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($address){
        $address = Address::withCount('order')->where('id', $address)->first();
        //dd($address);
        if($address->order_count > 0){
            // return response()->json(['error' => 'something went wrong'], 400);it related to another tables
             return redirect()->route('address')->with('success',' Cannot delete: this address has transactions');
         }
        $address->delete();
        return redirect()->route('address');
    }


}
