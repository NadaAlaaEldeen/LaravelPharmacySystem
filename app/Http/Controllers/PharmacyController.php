<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\User;
use App\Models\Area;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Requests\StorePharmacyRequest;

class PharmacyController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Pharmacy::select('id', 'priority', 'owner_user_id', 'area_id', 'name')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' .route("pharmacies.index").'" class="btn btn-success btn-sm mx-2">View</a>';
                    $btn .= '<a href="' . route('pharmacies.edit', $row->id) . '" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="' .route('pharmacies.destroy',  $row->id).'" class="btn btn-danger btn-sm">Delete</a>';

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
        $areas = Area::all();
        return view('pharmacy.create', ['areas' => $areas]);
    }

    public function store(StorePharmacyRequest $request)
       {
        if (isset($request->password)) {
            $request->password = bcrypt($request->password);
        }
        $path = null;
        if ($request->hasFile('avatar')) /*file field has value*/{
            $path = $request->file('avatar')->store('pharmacies', ['disk' => "public"]);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'national_id' => $request->national_id,
            'gender' => $request->gender,
            'password' => $request->password,
            'mobile' => $request->mobile,
            'birth_day'=> $request->date_of_birth,
            'avatar' => $path

        ]);
        $user->assignRole('pharmacy');
        $pharmacy= Pharmacy::create([
            'name' => $request->pharmacy_name,
            'priority' => $request->priority,
            'owner_user_id' => $user->id,
            'area_id' => $request->area_id,
        ]);
        return redirect()->route('pharmacies.index');
    }

    public function edit($pharmacy){

        $users = User::all();
        $areas = Area::all();
        $pharmacy = Pharmacy::find($pharmacy);
    
        return view('pharmacy.edit', ['pharmacy' => $pharmacy,'users' => $users],['areas' => $areas]);
    }

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

    public function destroy($pharmacy){
        $pharmacy = Pharmacy::withCount('doctors')->where('id', $pharmacy)->first();
        if($pharmacy->doctors_count > 0){
             return redirect()->route('pharmacies.index')->with('fail',' Cannot delete: This pharmacy has transactions');
         }
        $pharmacy->delete();
        return view('Pharmacy/index')->with('success', 'A Pharmacy is Updated Successfully!');
    }
}

