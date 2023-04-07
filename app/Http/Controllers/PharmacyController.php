<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\User;
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

    

    public function store(Request $request)
       {

        $pharmacy= Pharmacy::create([
            'name' => $request->name,
            'priority' => $request->priority,
            'owner_user_id' => $request->owner,
            'area_id' => $request->area_id,
        ]);

        return view('Pharmacy/index');
    }


    // public function store(StorePharmacyRequest $request)
    // {
    //     dd($request);
    //     $pharmacy = $request()->all();

    //      $email = request()->priority;
    //      dd($email);


    //      $pharmacy->creat(
    //         [
    //             //column name -> came data of name of input
    //             $pharmacy->priority => $request->priority,
    //             $pharmacy->owner_user_id => $request->Owner,
    //             $pharmacy->area_id = $request->area_id,
    //          ]);

    //     return to_route(route:'pharmacy');
    // }

    
    
    public function edit($pharmacy){
        $users = User::all();
        $pharmacy = Pharmacy::find($pharmacy);
        return view('pharmacy.edit', ['pharmacy' => $pharmacy,'users' => $users]);
    }
    
    
    public function update(Request $request, $pharmacy){

        $pharmacy = Pharmacy::find($pharmacy);
         $pharmacy->update(
            [
                $pharmacy->name  = $request->name,
                $pharmacy->priority  = $request->priority,
                $pharmacy->owner_user_id = $request->owner,
                $pharmacy->area_id = $request->area_id,
                $pharmacy->created_at = $request->created_at,
                $pharmacy->updated_at = $request->updated_at,
            ]);
        return view('Pharmacy/index')->with('success', 'A Pharmacy is Updated Successfully!');
    }



    public function destroy($pharmacy){
        $pharmacy = Pharmacy::where('id', $pharmacy)->first();
        if($pharmacy->doctor_count > 0){
             return redirect()->route('Pharmacy')->with('success',' Cannot delete: this pharmacy has transactions');
         }
        $pharmacy->delete();
        return view('Pharmacy/index')->with('success', 'A Pharmacy is Updated Successfully!');
    }


    public function restoreOne($id){
        $item = Pharmacy::withTrashed()->find($id);
        $item->restore();
        return view('Pharmacy/index');
       
    }

    public function restore(Request $req)
    {

        if ($req->ajax()) {
            $deleted = Pharmacy::onlyTrashed('deleted_at')->get();
            return Datatables::of($deleted)->addIndexColumn()
                ->addColumn('action', function ($result) {
                    // return '<a href="' . route('pharmacy.restoreOne', $result->id) .'" class="btn btn-primary btn-sm mx-2">restore</a>';
                    $form = '
                    <form action="' . route('pharmacy.restoreOne', $result->id) .'" method="POST">
                        ' . csrf_field() . '
                        <input type="hidden" name="_method" value="PUT">
                        <button type="submit" class="btn btn-primary btn-sm mx-2">Restore</button>
                    </form>
                ';
                    return $form;

                })->addColumn('Name',function(Pharmacy $pharmacy){
                    return $pharmacy->user->name;
                })->addColumn('area',function(Pharmacy $pharmacy){
                    return $pharmacy->area->name;
                })
                ->rawColumns(['action', 'Name'])
                ->make(true);
        }

        return view('Pharmacy/restore');
          }

        

}

