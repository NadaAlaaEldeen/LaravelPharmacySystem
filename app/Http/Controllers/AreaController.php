<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Address;
use App\Http\Requests\StoreAreaRequest;
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
                    $btn = '<a href="' .route("areas.index").'" class="btn btn-success btn-sm mx-2">View</a>';
                    $btn .= '<a href="' .route("areas.edit", $row->id).'" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="' .route("areas.destroy", $row->id).'" class="btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Areas/index');
    }




    public function create()
    {
        //$doctors = Medicine::all();
         //dd($doctors);

        return view('areas.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAreaRequest $request)
    {
        $Medicine= Area::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return to_route('areas');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($area){
        //dd($user_id);
        //$users = User::all();
        $area = Area::find($area);
        //dd($post);
        return view('areas.edit', ['area' => $area]);
    }
    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }
    public function update(Request $request, $area){
        //dd($request);
        $area = Area::find($area);
        //$d = $request->name;
        //dd($d);

         $area->update(
            [
                //column name -> came data of name of input
                $area->name = $request->name,
                $area->address = $request->address,
                $area->created_at = $request->created_at,
                $area->updated_at= $request->updated_at
             ]);
        //dd($doctor->name);
         return view('areas.index')->with('success', 'A Medicine is Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($area){
        $area = Area::withCount('addresses')->where('id', $area)->first();
        //dd($doctor1);
        //$doctor2 = User::where('id', $doctor)->first();
        //$doctor1->doctors->where('user_id', $doctor)->delete();
        if($area->addresses_count > 0){
           // return response()->json(['error' => 'something went wrong'], 400);it related to another tables
            return redirect()->route('areas')->with('success',' Cannot delete: this area has transactions');
        }
        $area->delete();
        return redirect()->route('areas');
        //return "hi";
        //dd($doctor);
    }
}
