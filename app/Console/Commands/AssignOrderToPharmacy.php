<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\Pharmacy;
use App\Models\Address;
use App\Mail\AssignOrderToPharmacyNotification;

class AssignOrderToPharmacy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign:orders-to-pharmacy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'scan new orders and assign them to pharmacies everyminute';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $orders = Order::where('status', 'New')->where('pharmacy_id', null)->get();
        foreach ($orders as $order) {
            $pharmacy = Pharmacy::where('area_id', Address::find($order->address_id)->area_id)
                ->orderBy('priority', 'desc')->first();
            if ($pharmacy) {
                $order->update([
                    'pharmacy_id' => $pharmacy->id,
                    'status' => 'Processing'
                ]);
            }
        }
    }
}
