<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\User;
use App\Models\Area;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Requests\StoreUsersPostRequest;

class PharmacyController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Pharmacy::select('id', 'priority', 'owner_user_id', 'area_id')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' .route("pharmacies.index").'" class="btn btn-success btn-sm mx-2">View</a>';
                    $btn .= '<a href="' . route('pharmacy.edit', $row->id) . '" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="' .route('pharmacy.destroy',  $row->id).'" class="btn btn-danger btn-sm">Delete</a>';

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


    public function create()
    {
        return view('pharmacy.create');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(StoreUsersPostRequest $request)
       {
        
        $user = User::create([
            'name' => $request->owner_name,
            'email' => $request->owner_mail,
            'national_id' => $request->national_id,
            'gender' => $request->gender,
            'password' => $request->password

        ]);
        $pharmacy= Pharmacy::create([
            'name' => $request->pharmacy_name,
            'priority' => $request->priority,
            'owner_user_id' => $user->id,
            'area_id' => $request->area_id,
        ]);
        return redirect()->route('pharmacies.index');
    }
    /**
     * Display the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($pharmacy){

        $users = User::all();
        $areas = Area::all();
        $pharmacy = Pharmacy::find($pharmacy);
    
        return view('pharmacy.edit', ['pharmacy' => $pharmacy,'users' => $users],['areas' => $areas]);
    }
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $pharmacy){
        $pharmacy = Pharmacy::find($pharmacy);
        $user = User::find($pharmacy->owner_user_id);
        $user->update(
            [
                $user->name = $request->user_name,
                $user->email = $request->user_mail,
             ]);
             
         $pharmacy->update(
            [
                $pharmacy->name  = $request->name,
                $pharmacy->priority  = $request->priority,
                $pharmacy->area_id = $request->area_id,
             ]);
             
             

        return redirect()->route('pharmacies.index')->with('success', 'A Pharmacy is Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($pharmacy){
        $pharmacy = Pharmacy::where('id', $pharmacy)->first();
        if($pharmacy->doctor_count > 0){
            // return response()->json(['error' => 'something went wrong'], 400);it related to another tables
             return redirect()->route('Pharmacy')->with('fail',' Cannot delete: this pharmacy has transactions');
         }
        $pharmacy->delete();
        return view('Pharmacy/index')->with('success', 'A Pharmacy is Updated Successfully!');
    }



}

