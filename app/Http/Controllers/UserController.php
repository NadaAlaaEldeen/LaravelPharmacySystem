<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRequest;

use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Client::select('id', 'user_id', 'is_inquired')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' .route('users.show', $row->id).'" class="btn btn-success btn-sm mx-2">View</a>';
                    $btn .= '<a href="' . route('users.edit', $row->id) . '" class="btn btn-primary btn-sm mx-2">Edit</a>';
                    $btn .= '<a href="' .route('users.destroy',  $row->id).'" class="btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })->addColumn('Name',function(Client $client){
                    return $client->user->name;
                })->addColumn('Email',function(Client $client){
                    return $client->user->email;
                })
                ->rawColumns(['action', 'Name', 'Email'])
                ->make(true);
        }

        return view('users/index');
    }

    public function show($user)
    {
        $users = User::all();
        $client = Client::find($user);
        return view("users.show", ["client" => $client]);
    }

    public function create()
    {
        
        return view('users.create');
    }

    public function store(StoreClientRequest $request)
       {
        if (isset($request->password)) {
            $request->password = bcrypt($request->password);
        }
        $path = null;
        if ($request->hasFile('avatar')) /*file field has value*/{
            $path = $request->file('avatar')->store('users', ['disk' => "public"]);
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
        $user->assignRole('client');

        $client= Client::create([
            'user_id' => $user->id,
            'is_inquired' =>$request->is_inquired
        ]);
        return redirect()->route('users.index')->with('success', 'A New Client is created Successfully!');
    }

    public function edit($user){

        $users = User::all();
        $client = Client::find($user);
        
        return view('users.edit', ['client' => $client,'users' => $users]);
    }

    public function update(Request $request, $user){
        $client = Client::find($user);
        $user = User::find($client->user_id);
        
        if ($request->hasFile('avatar')) /*choose file in file input*/{
            if($client->user->avatar) //if already existed image or not
                {
                    Storage::disk("public")->delete($client->user->avatar);
                }
            $path = $request->file('avatar')->store('users', ['disk' => "public"]);
        }
        else
        {
            $path = $client->user->avatar;
        }
      $user->update(
            [
                $user->name = $request->user_name,
                $user->email = $request->user_mail,
                $user->avatar = $path,
                $user->national_id = $request->national_id,
                $user->mobile = $request->mobile
             ]);
        return redirect()->route('users.index')->with('success', 'A Client is Updated Successfully!');
    }

public function destroy($user){
        $user = User::withCount('orders')->where('id', $user)->first();
        if($user->orders_count > 0){
             return redirect()->route('users.index')->with('fail',' Cannot delete: This client has transactions');
         }
         if($user->image){
            Storage::disk("public")->delete($user->avatar);
        }
        $pharmacy->delete();
        return redirect()->route('pharmacies.index')->with('success', 'A client is Deleted Successfully!');
    }
}
