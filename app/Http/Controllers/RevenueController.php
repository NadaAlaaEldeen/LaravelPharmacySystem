<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use DataTables;



class RevenueController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->hasRole("admin")){
            if ($request->ajax()) {

                $data = Pharmacy::latest()->get();
                return DataTables::of($data)
                ->addIndexColumn()


                  ->addColumn('total_order', function (Pharmacy $pharmacy) {
                    $ordersCount = DB::table('orders')->where('pharmacy_id', $pharmacy->id)->count();
                    return $ordersCount;
                })
                ->addColumn('total_revenue', function (Pharmacy $pharmacy) {
                    $ordersRevenue = DB::table('orders')->where('pharmacy_id', $pharmacy->id)
                                                    //->where('status', 'delivered')
                                                    ->sum('total_price');
                    return $ordersRevenue;
                })
                ->make(true);
            }
            return view('revenues/index');

    }

    else if(auth()->user()->hasRole("pharmacy")){
        $pharmacy_id =auth()->user()->id;
        $PharmacyRevenue = DB::table('orders')->where('pharmacy_id',$pharmacy_id)
                                                    ->sum('total_price');
       $pharmacy = Pharmacy::find(auth()->user()->id);
       $pharmacyName = $pharmacy->name;
       return view('revenues.allRevenue',['pharmacyRevenue'=>$PharmacyRevenue,'pharmacyName'=>$pharmacyName]);    }
    }

}

