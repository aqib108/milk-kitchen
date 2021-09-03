<?php

namespace App\Console\Commands;

use App\Models\OrderDeliverd;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\WeekDay;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class OrderDelivery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order_delivery';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Order Delivery on specific day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $current_day = Carbon::today()->format('l');
        $products = Product::count();
        $day_id = WeekDay::where('name',$current_day)->pluck('id');
        // Log::info($day);
       $orders = ProductOrder::where('day_id',$day_id)->get();
        Log::info($orders);
              $delivery = new OrderDeliverd;
              
        // for($i=1; $i<=$products; $i++)
        // {
        //     $delivery->user_id = $orders->user_id;
        //     $delivery->product_order_id = $orders->id;
        //     $delivery->day_id = $orders->day_id;
        //     $delivery->quantity = $orders->quantity;
        //     $delivery->save();
        // }

    }
}
