<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Product;
use App\Models\CasualOrder;
use DB;
class CasualMail extends Mailable
{
    use Queueable, SerializesModels;
    public $detail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detail)
    {
        $this->detail =$detail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $customerID= $this->detail->customer_id;
        $driverID= $this->detail->driver_id;
        $customer= User::whereId($customerID)->first();
        $driver= User::whereId($driverID)->first();
        $products = CasualOrder::leftjoin('products', 'products.id', 'casual_orders.product_id')
        ->where(['casual_orders.customer_id' => $customerID])
        ->select('products.name as name','products.description as desc','products.price as price', DB::raw('SUM(casual_orders.quantity) as carton'))
        ->groupBy('name','desc','price')
        ->get();
        return $this->view('mail.customerDeliveryMail',compact('products','customer','driver'));
    }
}
