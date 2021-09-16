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
        $current_day = Carbon::Today()->format('l');
        $day_id = WeekDay::where('name',$current_day)->pluck('id');
        $orders = ProductOrder::where('day_id',$day_id)->get();
        $productOrder = json_decode($orders, true);
        
        foreach($productOrder as $ord){
            $productPrices = Product::where('id','=',$ord['product_id'])->first();
            $productPrice = $productPrices->price;
            $quantity = $ord['quantity'];

            $data = OrderDeliverd::updateOrCreate([
                'user_id' => $ord['user_id'],
                'product_order_id' => $ord['id'],
                'product_id' => $ord['product_id'],
                'day_id' => $ord['day_id']],[
                'quantity' => $quantity,
            ]); 
        }    
    }
}
