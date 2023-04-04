<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use DataTables;

class AreaController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Area::select('id', 'name', 'address')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-success btn-sm mx-2">View</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Areas/index');
    }
}
