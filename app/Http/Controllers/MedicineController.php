<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Http\Requests\StoreMedicineRequest;
use DataTables;

class MedicineController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Medicine::select('id', 'name', 'type','price')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('medicines.edit', $row->id) . '" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="' .route('medicines.destroy',  $row->id).'" class="btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                    
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('medicine/index');
    }

    public function create()
    {

        return view('medicine/create');

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicineRequest $request)
    {
        $Medicine= Medicine::create([
            'name' => $request->name,
            'type' => $request->type,
            'price' =>  $request->price,
        ]);

        return redirect()->route('medicines.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($medicine){
        $medicine = Medicine::find($medicine);
        return view('medicine.edit', ['medicine' => $medicine]);
    }

    public function update(Request $request, $medicine){
        $medicine = Medicine::find($medicine);

         $medicine->update(
            [
                //column name -> came data of name of input
                $medicine->name = $request->name,
                $medicine->type = $request->type,
                $medicine->price = $request->price,
                $medicine->created_at = $request->created_at,
                $medicine->updated_at= $request->updated_at
             ]);
         return view('medicine.index')->with('success', 'A Post is Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($medicine){
        $medicine1 = Medicine::where('id', $medicine)->first();
        $medicine1->delete();
        return redirect()->route('medicines.index');
    }

}