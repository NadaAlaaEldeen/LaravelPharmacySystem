<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use DataTables;

class DoctorController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Doctor::select('id', 'is_ban', 'user_id', 'pharmacy_id', 'created_at')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-success btn-sm mx-2">View</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })->addColumn('Name',function(Doctor $doctor){
                    return $doctor->user->name;
                })->addColumn('pharmacy',function(Doctor $doctor){
                    return $doctor->pharmacy->user->name;
                })   
                ->rawColumns(['action', 'Name', 'pharmacy'])
                ->make(true);
        }

        return view('Doctor/index');
    }
}
