<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Client::select('id', 'user_id', 'is_inquired')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-success btn-sm mx-2">View</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })->addColumn('Name',function(Client $client){
                    return $client->user->name;
                })->addColumn('Email',function(Client $client){
                    return $client->user->email;
                })
                ->rawColumns(['action', 'Name', 'Email'])
                ->make(true);
        }

        return view('users/index');
    }
}
