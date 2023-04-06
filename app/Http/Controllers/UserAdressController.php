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
        return view('Address.create');
    }

    public function store(Request $request)
    {
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

    public function edit($address){
        $address = Address::find($address);
        return view('address.edit', ['address' => $address]);
    }
    
    public function update(Request $request, $address){
        $address = Address::find($address);
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
         return view('address.create')->with('success', 'A Address is Updated Successfully!');
    }

    public function destroy($address){
        $address = Address::withCount('order')->where('id', $address)->first();
        if($address->order_count > 0){
             return redirect()->route('address')->with('success',' Cannot delete: this address has transactions');
         }
        $address->delete();
        return redirect()->route('address');
    }


}
