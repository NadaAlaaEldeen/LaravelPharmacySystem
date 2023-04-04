<?php

namespace App\Http\Controllers;

use App\Models\Address;
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
                    $btn = '<a href="javascript:void(0)" class="btn btn-success btn-sm mx-2">View</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm">Delete</a>';
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
}
