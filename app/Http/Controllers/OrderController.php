<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Jobs\ProcessOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();  // begin db transaction

        try {

            // Create order
            if(!$request->user_id || !$request->amount){ // check if user_id and amount are given
                return response()->json(['error' => 'Please fill user_id and amount'], 400);
            }

            $order = Order::create([  // create order 
                'user_id' => $request->user_id,
                'amount' => $request->amount,
                'status' => 'pending',
            ]);


            // Dispatch async job
            ProcessOrder::dispatch($order->id);

            DB::commit(); // commit db transaction 

            return response()->json(['message' => 'Order created successfully'], 201);
        } catch (\Exception $e) {

            DB::rollBack(); // rollback db transaction on error

            Log::error('Order creation failed: '.$e->getMessage()); // log the error message

            return response()->json(['error' => 'Failed to create order'], 500);
        }
    }
}