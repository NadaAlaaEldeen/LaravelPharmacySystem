<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
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
                $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm mx-2">Delete</a>';
                if ($row->is_ban) {
                  $btn .= '<form action="' . route('doctors.unban', $row->id) .'" method="POST">
                        ' . csrf_field() . '
                        <input type="hidden" name="_method" value="POST">
                        <button type="submit" class="btn btn-warning btn-sm mx-2 ">UnBan</button>
                    </form>
                ';
                     
                } else {
                    $btn .= '
                    <form action="' . route('doctors.ban', $row->id) .'" method="POST">
                        ' . csrf_field() . '
                        <input type="hidden" name="_method" value="POST">
                        <button type="submit" class="btn btn-warning btn-sm mx-2">Ban</button>
                    </form>
                ';
                }
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


public function ban($id)
{
    $doctor = Doctor::find($id);
    $doctor->is_ban = true;
    $doctor->save();
    $banned = $doctor->ban();
    return view('doctor/index')->with('banned', $banned);;
}

public function unban($id)
{
    $doctor = Doctor::find($id);
    $doctor->is_ban = false;
    $unbanned = $doctor->unban();
    $doctor->save();
    return view('doctor/index')->with('banned', $unbanned);;
}
}
