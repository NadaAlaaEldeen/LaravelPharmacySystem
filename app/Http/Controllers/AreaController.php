<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Address;
use App\Models\Country;
use App\Http\Requests\StoreAreaRequest;
use Illuminate\Http\Request;
use DataTables;

class AreaController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Area::select('id','country_id', 'name', 'address')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' .route("areas.edit", $row->id).'" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="' .route("areas.destroy", $row->id).'" class="btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })->addColumn('country',function(Area $area){
                    return $area->country->capital;
                })
                ->rawColumns(['action', 'country'])
                ->make(true);
        }

        return view('Areas.index');
    }


    public function create()
    {
        $countries = Country::all();
        return view('Areas.create', ['countries' => $countries]);
    }
    public function store(StoreAreaRequest $request)
    {
        $Medicine= Area::create([
            'name' => $request->name,
            'address' => $request->address,
            'country_id' => $request->country_id,
        ]);

        return redirect()->route('areas.index');
    }
    public function edit($area){
        $area = Area::find($area);
        $countries = Country::all();
        return view('areas.edit', ['area' => $area], ['countries' => $countries]);
    }
    
    public function update(Request $request, $area){
        $area = Area::find($area);

         $area->update(
            [
                //column name -> came data of name of input
                $area->name = $request->name,
                $area->address = $request->address,
                $area->country_id = $request->country_id,
             ]);
         return redirect()->route('areas.index')->with('success', 'An Area is Updated Successfully!');
    }

    public function destroy($area){
        $area = Area::withCount('addresses','pharmacies' )->where('id', $area)->first();
        
        if($area->addresses_count > 0 || $area->pharmacies_count > 0){
            return redirect()->route('areas.index')->with('fail',' Cannot delete: This area has transactions');
        }
        $area->delete();
        return redirect()->route('areas.index')->with('success', 'An Area is Updated Successfully!');
    }
}
