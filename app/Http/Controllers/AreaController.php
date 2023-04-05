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
                    $btn = '<a href="' .route("areas.edit", $row->id).'" class="btn btn-primary btn-sm mx-2">Edit</a>';
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
        $area = Area::find($area);
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
        $area = Area::find($area);

         $area->update(
            [
                //column name -> came data of name of input
                $area->name = $request->name,
                $area->address = $request->address,
                $area->created_at = $request->created_at,
                $area->updated_at= $request->updated_at
             ]);
         return view('areas.index')->with('success', 'A Medicine is Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($area){
        $area = Area::withCount('addresses')->where('id', $area)->first();
        
        if($area->addresses_count > 0 ){
            return redirect()->route('areas')->with('fail',' Cannot delete: this area has transactions');
        }
        // $area = Area::withCount('pharmacies')->where('id', $area)->first();
        // if($area->pharmacies_count > 0 ){
        //     return redirect()->route('areas')->with('success',' Cannot delete: this area');
        // }
        $area->delete();
        return redirect()->route('areas');
    }
}
