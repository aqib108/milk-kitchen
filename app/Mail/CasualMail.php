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
        $time=CasualOrder::orderBy('created_at','desc')->latest()->first()->created_at;
        $customer= User::join('customer_details','customer_details.user_id','users.id')
        ->where('users.id',$customerID)
        ->select('customer_details.business_name as business_name','users.id as id','users.email as email')->first();
        $driver= User::join('customer_details','customer_details.user_id','users.id')
        ->where('users.id',$driverID)
        ->select('customer_details.business_name as business_name','users.id as id','users.email as email')->first();
        $products = CasualOrder::leftjoin('products', 'products.id', 'casual_orders.product_id')
        ->where(['casual_orders.customer_id' => $customerID])
        ->whereBetween('casual_orders.created_at', [$time, now()])
        ->select('products.name as name','products.description as desc','products.price as price', DB::raw('SUM(casual_orders.quantity) as carton'))
        ->groupBy('name','desc','price')
        ->get();
        return $this->view('mail.customerDeliveryMail',compact('products','customer','driver'));
    }
}
