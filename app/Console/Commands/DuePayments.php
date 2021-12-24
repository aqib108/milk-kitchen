<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductOrder;
use Mail;
class DuePayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'duepayments';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'duepayments';

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
        $products = Product::all();
        $users = User::role('Customer')->get(); 
        $supper =array();
        foreach ($users as $key => $value) {
            $userName =$value->name;
            $userId = $value->id;
            $email =$value->email;
            $orders = $products->map(function ($p) use($value) {   
                $p->productscount = ProductOrder::where('product_id',$p->id)->where('user_id',$value->id)
                ->latest()
                ->get()
                ->groupBy(function($date) {
                    return Carbon::parse($date->updated_at)->startOfWeek()->format('d-m-Y');
                });
             return $p;    
            });
            $array1=array();
            $array2=array();
            $resultant=array();
            $statementvalue=0;
            foreach ($orders as $key => $value) {
                       $productPrice = $value->price;
                       
                foreach ($value->productscount as $key => $value1) {   
                        $date = Carbon::parse($key);
                        $start = $date->startOfWeek()->format('d-m-Y');
                        $end = $date->endOfWeek()->format('d-m-Y');
                        if(!in_array($key,$array1))
                        {
                                array_push($array1,$key);
                                $statementvalue=$value1->sum('quantity')*$productPrice;
                                $array2= [
                                    'start' => $start,
                                    'end'   => $end,
                                    'email' =>$email,
                                    'userId' => $userId,
                                    'name' =>$userName,
                                    'price' => $statementvalue,
                                ];
                                array_push($resultant,$array2);
                        }
                        else
                        {  
                                foreach ($resultant as $key => $value) {
                                    if($value['start'] == $start && $value['end'] == $end)
                                    {
                                        $resultant[$key]['price']=$value['price']+$value1->sum('quantity')*$productPrice;
                                    }
                                }
                        }         
                    }
                }
                 array_push($supper,$resultant);
            }   
       foreach ($supper as $key => $value) {
            foreach ($value as $key => $value1) {
                $date=date_create(date('Y-m-d'));
                $v=date_sub($date,date_interval_create_from_date_string("1 days"));
                // dd($v->format('Y-m-d'));
                if($value1['end'] == $v->format('Y-m-d'))
                {
                    Mail::send('mail.customerDuePayment', ['data'=>$value1], function($message) use($value1){
                        $message->to($value1['email'], 'Tutorials Point')->subject
                           ('Due Payment');
                    });     
               }
               else
               {
                return Command::SUCCESS;
               }
           }
       }
    
      
       
    }
}