<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use App\Http\Resources\OrderResource;

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
}
;