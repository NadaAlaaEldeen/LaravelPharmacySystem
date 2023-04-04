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
                    $btn = '<a href="' .route("medicines.index").'" class="btn btn-success btn-sm mx-2">View</a>';
                    //$btn .= '<a href="' .route('medicine.edit',$medicine->id).'" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="' . route('medicine.edit', $row->id) . '" class="btn btn-primary btn-sm mx-2">Edit</a>';

                    $btn .= '<a href="' .route('medicine.destroy',  $row->id).'" class="btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                    
    
                })


                ->rawColumns(['action'])
                ->make(true);
        }

        return view('medicine/index');
    }

    public function create()
    {
        //$doctors = Medicine::all();
         //dd($doctors);

        return view('medicine/create');

    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicineRequest $request)
    {
        //dd($request);
        $Medicine= Medicine::create([
            'name' => $request->name,
            'type' => $request->type,
            'price' =>  $request->price,
        ]);

        return view('medicine/index');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($medicine){
        //dd($medicine);
        //dd($user_id);
        //$users = User::all();
        $medicine = Medicine::find($medicine);
        //dd($post);
        return view('medicine.edit', ['medicine' => $medicine]);
       //return $medicine;
    }
    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }
    public function update(Request $request, $medicine){
        //dd($request);
        $medicine = Medicine::find($medicine);
        //$d = $request->name;
        //dd($d);

         $medicine->update(
            [
                //column name -> came data of name of input
                $medicine->name = $request->name,
                $medicine->type = $request->type,
                $medicine->price = $request->price,
                $medicine->created_at = $request->created_at,
                $medicine->updated_at= $request->updated_at
             ]);
        //dd($doctor->name);
         return view('medicine.index')->with('success', 'A Post is Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($medicine){
        //dd($medicine);
        $medicine1 = Medicine::where('id', $medicine)->first();
        //dd($medicine1);
        //$doctor2 = User::where('id', $doctor)->first();
        //$doctor1->doctors->where('user_id', $doctor)->delete();

        $medicine1->delete();
        return redirect()->route('medicines.index');
        //return "hi";
        //dd($doctor);
    }

}