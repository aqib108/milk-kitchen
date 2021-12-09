<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User;
use File;
use Illuminate\Support\Carbon;
use Response;
use Auth;
use DB;
class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function weekelySales(Request $request)
    {

        $products = Product::all();
        $orders = $products->map(function ($p) {
            $p->productscount = ProductOrder::where('product_id', $p->id)->latest()->get()->groupBy(function ($date) {
                return Carbon::parse($date->updated_at)->startOfWeek()->format('d-m-Y');
            });
            return $p;
        });
        $array1 = array();
        $array2 = array();
        $resultant = array();
        $statementvalue = 0;
        foreach ($orders as $key => $value) {
            $productPrice = $value->price;
            foreach ($value->productscount as $key => $value1) {
                $statementPrice=0;
                $date = Carbon::parse($key);
                $start = $date->startOfWeek()->format('Y-m-d'); // 2016-10-17 00:00:00.000000
                $end = $date->endOfWeek()->format('Y-m-d');
                $regionName = $value1->first()->region_name;
                if (!in_array($key, $array1)) {
                    array_push($array1, $key);
                    $statementvalue = $value1->sum('quantity') * $productPrice;
                    $array2 = [
                        'start' => $start,
                        'end'   => $end,
                        'region' => $regionName,
                        'statementPrice' => $statementvalue,
                    ];
                    array_push($resultant, $array2);
                } else {

                    foreach ($resultant as $key => $value) {
                        if ($value['start'] == $start && $value['end'] == $end) {
                            $resultant[$key]['statementPrice'] = $value['statementPrice'] + $value1->sum('quantity') * $productPrice;
                        }
                    }
                }
            }
        }


        return view('admin.sale.directDebiting', compact('resultant'));
    }
    public function getCsv($start,$end){
        
        $startDate=$start;
        $endDate=$end;
            $products = Product::all();
            $orders = $products->map(function ($p) use ($start,$end) {
                $p->productscount = ProductOrder::whereDate('updated_at','>=',$start)->whereDate('updated_at','<=',$end)->where('product_id', $p->id)->get();
                return $p;
            });
        $array1 = array();
        $array2 = array();
        $resultant = array();
        $statementvalue = 0;
        foreach ($orders as $key => $value) {
            $productPrice = $value->price;
            foreach ($value->productscount as $key => $value1) {
                $statementPrice=0;
                $regionName = $value1->region_name;
                if (!in_array($value1->user_id, $array1)) {
                
                    array_push($array1, $value1->user_id);
                    $statementvalue = $value1->quantity * $productPrice;
                    $array2 = [
                        'start' => $startDate,
                        'end'   => $endDate,
                        'user_id' => $value1->user_id,
                        'name' =>User::whereId($value1->user_id)->first()->name,
                        'region' => $regionName,
                        'statementPrice' => $statementvalue,
                    ];
                    array_push($resultant, $array2);
                } else {
                    $statementPrice = $value1->quantity * $productPrice;
                    foreach ($resultant as $key => $value) {
                        if ($value['user_id'] == $value1->user_id) {
                            $resultant[$key]['statementPrice'] = $value['statementPrice'] + $statementPrice;
                        }
                    }
                }
            }
        }
        // these are the headers for the csv file.
        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Disposition' => 'attachment; filename=download.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        );


        //I am storing the csv file in public >> files folder. So that why I am creating files folder
        if (!File::exists(public_path()."/files")) {
            File::makeDirectory(public_path() . "/files");
        }

        //creating the download file
        $filename =  public_path("files/download.csv");
        $handle = fopen($filename, 'w');

        //adding the first row
        fputcsv($handle, [
            "Name",
            "statementPrice",
            'start',
            'end'
        ]);

        //adding the data from the array
        foreach ($resultant as $each_user) {
            fputcsv($handle, [
                $each_user['name'],
                $each_user['statementPrice'],
            ]);

        }
        fclose($handle);

        //download command
        return Response::download($filename, "download.csv", $headers);
    }
    
    public function customerOwingReport()
    {
        $products = Product::all();
        $users = User::all();
      

        // $orders = $users->map(function ($p) {
        //     $p->productscount = ProductOrder::where('user_id', $p->id)->latest()->get()->groupBy(function ($date) {
        //         return Carbon::parse($date->updated_at)->startOfWeek()->format('d-m-Y');
        //     });
        //     if($p->productscount->isNotEmpty())
        //      return $p;
        //      else
        //       return 0;
        // });
        // dd($orders);
        foreach ($users as $key => $value) {
            
        $orders = $products->map(function ($p) use($value) {   
                        $p->productscount = ProductOrder::where('product_id', $p->id)
                        ->where('user_id', $value->id)
                        ->latest()
                        ->get()
                        ->groupBy(function ($date) {
                            return Carbon::parse($date->updated_at)->startOfWeek()->format('d-m-Y');
                        });
                     return $p;    
        });
    }
        dd($orders);
    //  foreach ($orders as $key => $value1) {
    //        foreach ($users as $key => $value) {
    //            dd($value1->productscount);
    //             $p=$value1->productscount->groupBy($value->id)->get();
    //             dd($p);          
    //        }
    //  }

        //    $pro=ProductOrder::join('products','products.id','product_orders.product_id')
        //                  ->join('users','users.id','product_orders.user_id')
        //                  ->select('users.name as userName', DB::raw('SUM(product_orders.quantity*products.price) as carton'))
        //                  ->groupBy('userName')
        //                   ->get();
        //                   dd($pro);

               
      return view('admin.customer.customerOwingReport');
    }
}
