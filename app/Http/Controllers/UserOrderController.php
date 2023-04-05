<?php

namespace App\Http\Controllers;

//use App\Models\Area;
use App\Models\Order;
use Illuminate\Http\Request;
use DataTables;

class UserOrderController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Order::select('id', 'status', 'is_insured' , 'total_price' , 'pharmacy_id' , 'user_id')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' .route("orders.edit", $row->id).'" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="' .route("orders.destroy", $row->id).'" class="btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Orders/index');
    }




    public function create()
    {
        return view('areas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreAreaRequest $request)
    // {
    //     $Medicine= Area::create([
    //         'name' => $request->name,
    //         'address' => $request->address,
    //     ]);

    //     return to_route('areas');
    // }

    // /**
    //  * Display the specified resource.
    //  */


    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit($area){
    //     $area = Area::find($area);
    //     return view('areas.edit', ['area' => $area]);
    // }
    // /**
    //  * Update the specified resource in storage.
    //  */
    // // public function update(Request $request, string $id)
    // // {
    // //     //
    // // }
    // public function update(Request $request, $area){
    //     $area = Area::find($area);

    //      $area->update(
    //         [
    //             //column name -> came data of name of input
    //             $area->name = $request->name,
    //             $area->address = $request->address,
    //             $area->created_at = $request->created_at,
    //             $area->updated_at= $request->updated_at
    //          ]);
    //      return view('areas.index')->with('success', 'A Medicine is Updated Successfully!');
    // }


    // /**
    //  * Remove the specified resource from storage.
    //  */

    // public function destroy($area){
    //     $area = Area::withCount('addresses')->where('id', $area)->first();

    //     if($area->addresses_count > 0 ){
    //         return redirect()->route('areas')->with('success',' Cannot delete: this area has transactions');
    //     }

    //     $area->delete();
    //     return redirect()->route('areas');
    // }
}
