<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Models\Order;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        try {
            $snapToken = $order->snap_token;
            if (empty($snapToken)) {
                $midtrans = new CreateSnapTokenService($order);
                $snapToken = $midtrans->getSnapToken();

                $order->snap_token = $snapToken;
                $order->save();
            }
        } catch (\Exception $e) {
            Log::error('Error in generating snap token: ' . $e->getMessage());
            return back()->withErrors('Failed to generate payment token. Please try again.');
        }

        return view('orders.show', compact('order', 'snapToken'));
    }
}
