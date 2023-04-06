<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use App\Models\Area;
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
                    $btn .= '<a href="' .route("addresses.edit", $row->id).'" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="' .route("addresses.destroy", $row->id).'" class="btn btn-danger btn-sm">Delete</a>';
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
        $users = User::all();
        $areas = Area::all();

        return view('Address.create', ["users" => $users], ["areas" => $areas]);
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
        ]);

        return to_route('addresses.index');
    }

    public function edit($address){
        $address = Address::find($address);
        $areas = Area::all();
        
        return view('Address.edit', ['address' => $address], ['areas' => $areas]);
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
         return view('Address.index')->with('success', 'An Address is Updated Successfully!');
    }

    public function destroy($address){
        $address = Address::withCount('order')->where('id', $address)->first();
        if($address->order_count > 0){
             return redirect()->route('addresses.index')->with('fail',' Cannot delete: this address has transactions');
         }
        $address->delete();
        return redirect()->route('addresses.index');
    }


}
