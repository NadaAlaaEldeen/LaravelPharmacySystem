<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Pharmacy;
use DataTables;

class DoctorController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Doctor::select('id', 'is_ban', 'user_id', 'pharmacy_id', 'created_at')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' .route('Doctor.show', $row->id).'" class="btn btn-success btn-sm mx-2">View</a>';
                    $btn .= '<a href="' . route('Doctor.edit', $row->id) . '" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="' .route('Doctor.destroy',  $row->id).'" class="btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })->addColumn('Name',function(Doctor $doctor){
                    return $doctor->user->name;
                })->addColumn('pharmacy',function(Doctor $doctor){
                    return $doctor->pharmacy->user->name;
                })
                ->rawColumns(['action', 'Name', 'pharmacy'])
                ->make(true);
        }

        return view('Doctor/index');
    }



     public function create()
    {
        // $doctors = Doctor::all();
        //  //dd($doctors);

        // return view('Doctor.create', $doctors->id);
        $pharmacies = Pharmacy::all();
        //dd($pharmacies);
        return view('Doctor.create',['pharmacies' => $pharmacies]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
        $user = new User([
            'name'=>$request ->input('name'),
            'email'=>$request ->input('email'),
            'password'=>$request ->input('password')
              ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('doctors', ['disk' => "public"]);
            $user->avatar= $image;
        }


        $doctors = $request()->all();



         $doctors->create(
            [
                //column name -> came data of name of input
                $doctors->name => $request->name,
                $doctors->email => $request->Email,
                $doctors->password => $request->password,
                //$doctors->avatar = $request->$path,
                 $doctors->National_id=> $request->National_id
                // 'pharmacy_id' => $request->Password
             ]);


             $doctors->save();
             $user->save();
        return to_route(route:'doctor');
    }

    /**
     * Display the specified resource.
     */
    public function show($doctor)
    {
        $users = User::all();
        $post = User::find($doctor);
        //dd($post->email);

        return view('Doctor.show',['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($doctor){
    //     //dd($user_id);
    //     $users = User::all();
    //     $post = User::find($doctor);
    //     //dd($post);
    //     return view('doctors.edit', ['doctors' => $post,'users' => $users]);
    // }
    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }
    // public function update(Request $request, $doctors){
    //     //dd($request);
    //     $doctors = User::find($doctors);
    //     //$d = $request->name;
    //     //dd($d);

    //      $doctors->update(
    //         [
    //             //column name -> came data of name of input
    //             $doctors->name = $request->name,
    //             $doctors->mobile = $request->phone,
    //             $doctors->email = $request->email,
    //             $doctors->password = $request->password,
    //             $doctors->avatar = $request->avatar_image,
    //              $doctors->National_id=> $request->National_id
    //             // 'pharmacy_id' => $request->Password
    //          ]);
    //     //dd($doctor->name);
    //      return view('doctors.create')->with('success', 'A Post is Updated Successfully!');
    // }


    /**
     * Remove the specified resource from storage.
     */

    // public function destroy($doctor){
    //     $doctor1 = User::where('id', $doctor)->first();
    //     //dd($doctor1->email);
    //     //dd($doctor1);
    //     //$doctor2 = User::where('id', $doctor)->first();
    //     $doctor1->doctors->where('user_id', $doctor)->delete();
    //     //$doctor1->delete();
    //     //return redirect()->route('doctors.index', $doctor['user_id'] );
    //     return "hi";
    //     //dd($doctor);
    // }

}


