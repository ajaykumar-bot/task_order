<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessOrder implements ShouldQueue
{
    use Dispatchable, Queueable;

    protected $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    public function handle()
    {
        $order = Order::find($this->orderId);

        if (!$order) {
            Log::error("Order not found: ID {$this->orderId}"); // log the order is not found with the given id
            return;
        }

        DB::beginTransaction();

        try {
            // do some thing with order like update status
            sleep(5);

            $order->update(['status' => 'processed']);

            DB::commit();

            Log::info("Order processed successfully: ID {$order->id}"); // log the process 
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Order processing failed: " . $e->getMessage()); // log the error with message
        }
    }
}
