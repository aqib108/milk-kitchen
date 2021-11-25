<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\User;
use App\Models\ProductOrder;
use DB;
use Illuminate\Queue\SerializesModels;

class CustomerMail extends Mailable
{
    use Queueable, SerializesModels;
    public $detail;
    public $productOrderId;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detail, $productOrderId)
    {
        $this->detail =$detail;
        $this->productOrderId=$productOrderId;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $pId=$this->productOrderId;
        $customerID= $this->detail->customer_id;
        $driverID= $this->detail->driver_id;
        $customer= User::whereId($customerID)->first();
        $driver= User::whereId($driverID)->first();
           $dayId=ProductOrder::whereId($pId)->first()->day_id;
        $products = ProductOrder::leftjoin('products', 'products.id', 'product_orders.product_id')
        ->where(['product_orders.user_id' => $customerID,'product_orders.day_id' => $dayId])
        ->select('products.name as name','products.description as desc',
        'products.price as price', DB::raw('SUM(product_orders.quantity) as carton'))
        ->groupBy('name','desc','price')
        ->get();
        return $this->view('mail.customerDeliveryMail',compact('products','customer','driver'));
    }
}
