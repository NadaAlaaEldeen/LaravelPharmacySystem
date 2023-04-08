<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersPostRequest;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Pharmacy;
use DataTables;
use App\Http\Controllers\UserController;


class DoctorController extends Controller
{

    public function index(Request $request)
    {
   
        if ($request->ajax()) {
            $data = Doctor::select('id', 'is_ban', 'user_id', 'pharmacy_id', 'created_at')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' .route('doctors.show', $row->id).'" class="btn btn-success btn-sm mx-2">View</a>';
                    $btn .= '<a href="' . route('doctors.edit', $row->id) . '" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="' .route('doctors.destroy',  $row->id).'" class="btn btn-danger btn-sm">Delete</a>';
                    if ($row->is_ban) {
                        $btn .= '<form action="' . route('doctors.unban', $row->id) .'" method="POST">
                              ' . csrf_field() . '
                              <input type="hidden" name="_method" value="POST">
                              <button type="submit" class="btn btn-warning btn-sm mx-2 my-3 ">UnBan</button>
                          </form>
                      ';
                           
                      } else {
                          $btn .= '
                          <form action="' . route('doctors.ban', $row->id) .'" method="POST">
                              ' . csrf_field() . '
                              <input type="hidden" name="_method" value="POST">
                              <button type="submit" class="btn btn-warning btn-sm mx-2 my-3">Ban</button>
                          </form>
                      ';
                      }
                    return $btn;
                })->addColumn('Name',function(Doctor $doctor){
                    return $doctor->user->name;
                })->addColumn('pharmacy',function(Doctor $doctor){
                    return $doctor->pharmacy->user->name;
                })
                ->rawColumns(['action', 'Name', 'pharmacy'])
                ->make(true);
        }
        if (auth()->user()->hasRole(["pharmacy"])) 
        {
            $pharmacy = Pharmacy::where('owner_user_id', auth()->user()->id)->first();
            $doctors = Doctor::all();
            return view("doctors/index", ["pharmacy" => $pharmacy],['doctors' => $doctors]);
        }
        return view('doctors/index');
    }



     public function create()
    {
        $doctor = Doctor::all();
        $pharmacies = Pharmacy::all();
        return view('doctors.create', ['pharmacies' => $pharmacies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User([
            'name'=>$request ->input('name'),
            'email'=>$request ->input('email'),
            'national_id' => $request->input('national_id'),
            'gender' => $request->gender,
            'mobile' => $request->phone,
            'birth_day'=> $request->date_of_birth,
            ]);
            if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
            }

            if($request->hasFile('avatar')){

                $avatar=request()->file('avatar');
                $filename=time().$request->file('avatar')->getClientOriginalName();
                $path = $request->file('avatar')->storeAs('images', $filename, 'public');
                $avatar = '/storage/'.$path;
                $user->avatar= $filename;
            }
            $user->avatar= $avatar;
            $user->save();
            if (auth()->user()->hasRole(["pharmacy"])) 
            { 
                $pharmacy = Pharmacy::where('owner_user_id', auth()->user()->id)->first();
                $parmacy_id = $pharmacy->id;
            }
            else 
            {
                $parmacy_id = $request->input('pharmacy_id');
            }
        $doctor=new Doctor([
            'pharmacy_id' => $parmacy_id,
            'is_ban' => $request->input('is_ban'),
            'user_id' => $user->id,
        ]);

            $doctor->save();
            return redirect()->route('doctors.index')->with('success',' Doctor Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($doctor)
    {
        $users = User::all();
        $doctor = Doctor::where('id', $doctor)->first();
        return view('doctors.show',['doctor' => $doctor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($doctor)
    {
        $doctor = Doctor::find($doctor);
        return view('doctors.edit', ['doctor' => $doctor]);
    }
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $doctor){

        $doctor = Doctor::find($doctor);
        $user = User::find($doctor->user->id);
        $doctor->is_ban= $request->input('is_ban');
        $doctor->save();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->national_id = $request->input('national_id');

        if($request->hasFile('avatar')){

                $avatar=request()->file('avatar');
                $filename=time().$request->file('avatar')->getClientOriginalName();
                $path = $request->file('avatar')->storeAs('images', $filename, 'public');
                $avatar = '/storage/'.$path;
                $user->avatar= $filename;
            }
            $user->avatar= $avatar;


        $user->save();
        return redirect()->route('doctors.index')->with('success','A Doctor Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($doctor){
    $doctor = Doctor::withCount('order')->where('id',$doctor)->first();
    $user = User::findOrFail($doctor->user_id);
    if($doctor->order_count > 0){
        return redirect()->route('doctors.index')->with('success',' Cannot delete: the doctor has transactions');
    }
    $doctor->delete();
    $user->delete();
    return redirect()->route('doctors.index')->with('success',' Doctor Deleted Successfully!');
    }
    public function ban($id)
{
    $doctor = Doctor::find($id);
    $doctor->is_ban = true;
    $doctor->save();
    UserController::updateStatus($doctor->user_id,0);
    return view('doctors/index');

}

public function unban(UserController $userController,$id)
{
    $doctor = Doctor::find($id);
    $doctor->is_ban = false;
    $doctor->save();
    $userController->updateStatus($doctor->user_id,1);
    return view('doctors/index');
}

}


