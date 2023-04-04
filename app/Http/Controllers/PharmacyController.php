<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use DataTables;

class PharmacyController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Pharmacy::select('id', 'priority', 'owner_user_id', 'area_id')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-success btn-sm mx-2">View</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })->addColumn('Name',function(Pharmacy $pharmacy){
                    return $pharmacy->user->name;
                })->addColumn('area',function(Pharmacy $pharmacy){
                    return $pharmacy->area->name;
                })    
                ->rawColumns(['action', 'Name'])
                ->make(true);
        }

        return view('Pharmacy/index');
    }
}

