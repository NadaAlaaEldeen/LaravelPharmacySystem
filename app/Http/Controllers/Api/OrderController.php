<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Pharmacy;
use App\Models\Address;
use App\Models\MedicineOrder;
use App\Models\OrderMedicine;
use App\Models\Medicine;
use App\Models\User;
use App\Http\Resources\OrderResource;
use App\Models\OrderImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Api\StoreOrderapiRequest;
use App\Http\Requests\Api\UpdateOrderapiRequest;
use Illuminate\Support\Facades\Storage;


class OrderController extends Controller
{
    public function show($order_id)
    {
        $user_id = Auth::id();
        $order = Order::with('address')->with('pharmacy')->with('medicine')->find($order_id);
        if ($order->user_id == $user_id) {
            $order_details = new OrderResource($order);
            return $order_details;
        }
        return response()->json(['message' => 'Order Not Found'], 404);
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return OrderResource::collection($orders);
    }

    public function store(Request $request)
    {
        $request->validate([
            'delivering_address_id' => ['required'],
            'is_insured' => ['required'],
            'prescription' => ['required']
        ]);
        $address = Address::where('id', $request->delivering_address_id)->where('user_id', Auth::id())->first();
        if (!$address) {
            return response()->json([
                'error' => 'Address not found'
            ], 403);
        }
        $order = Order::Create([
            'user_id' => Auth::id(),
            'status' => 'New',
            'address_id' => $request->delivering_address_id,
            'is_insured' => $request->is_insured,
            'pharmacy_id' => null,
            'total_price' => 0,
        ]);
        // foreach ($request->file($prescription) as $image) {
        $prescription = $request->prescription;
        $new_name = time() . '.' . $prescription->getClientOriginalExtension();
        $prescription->move(public_path('images/orders'), $new_name);
        OrderImage::Create([
            'order_id' =>  $order->id,
            'image' => $new_name,
        ]);
        // }
        return response()->json(new OrderResource($order), 201);
    }

    public function putMedicineOrder(Request $request)
    {
        $request->validate([
            'order_id' => ['required'],
            'medicine_id' => ['required'],
            'quantity' => ['required']
        ]);

        MedicineOrder::Create([
            'order_id' =>  $request->order_id,
            'medicine_id' =>  $request->medicine_id,
            'quantity' =>  $request->quantity,
        ]);

        $medicine = Medicine::find($request->medicine_id);
        $order = Order::find($request->order_id);
        $old_total_price = $order->total_price ? $order->total_price : 0;
        $total_price = $old_total_price + ($medicine->price * $request->quantity);

        $order->update([
            'total_price' => $total_price,
        ]);

        return response()->json('Medicine added to the order');
    }
    public function getTotalPrice($id)
    {
        $order = Order::find($id);
        return response()->json('Your order total price' . $order->total_price);
    }



    public function update($id, Request $request)
    {
        $order = Order::find($id);
        if ($order->status == 'New') {

            if ($request->hasFile('prescription')) {
                $order_images = OrderImage::where('order_id', $id)->get();
                foreach ($order_images as $order_image) {
                    File::delete(public_path("images/orders/$order_image->image"));
                    $order_image->delete();
                }
                $files = $request->allFiles();

                foreach ($files as $file) {
                    $new_name = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/orders'), $new_name);
                    OrderImage::Create([
                        'order_id' =>  $order->id,
                        'image' => $new_name,
                    ]);
                }
            }

            $order->update([
                'status' => $request->status,
                'is_insured' => $request->is_insured,
            ]);

            return response()->json('updated');
        }
        return response()->json('can\'t update this order');
    }


    public function getUnAssignedOrders()
    {
        $orders = Order::where('status', 'New')->where('pharmacy_id', null)->get();
        foreach ($orders as $order) {
            $this->assignPharmacyToOrder($order->id);
        }
    }

    public function assignPharmacyToOrder($id)
    {
        $order = Order::find($id);
        $pharmacy = Pharmacy::where('area_id', Address::find($order->address_id)->area_id)
            ->orderBy('priority', 'desc')->first();
        if ($pharmacy) {
            $order->update([
                'pharmacy_id' => $pharmacy->id
            ]);

            return response()->json('Assign successfully to pharmacy' . $pharmacy->name);
        }
        return response()->json("Can't find pharmacy in this area");
    }
};
