<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Setting;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\AllocatePayment;
use App\Models\CustomerDetail;
use App\Models\PlannedPayment;
use File;
use Illuminate\Support\Carbon;
use Response;
use Auth;
use Yajra\DataTables\DataTables;
use DB;
use Hamcrest\Core\AllOf;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       return view('admin.customer.import');
    }
     /**
    * @return \Illuminate\Support\Collection
    */
    public function importExcelCSV(Request $request,AllocatePayment $allocatePayment) 
    {
        $validatedData = $request->validate([
           'file' => 'required|mimes:csv',
        ]);
        Excel::import($allocatePayment,$request->file('file'));
 
            
        return redirect()->route('sale.index')->with('success', 'The file imported successfully');
    }

    public function reverse_payment(Request $request)
    {
         $v=AllocatePayment::where('customerId',$request->customer)
         ->whereDate('updated_at','=',$request->date)
         ->whereTime('updated_at','=',$request->time)
         ->update(['reversed'=>1]);
         return response()->json(['success'=>'Payment Reversed Successfully!.']); 
    }
    public function planned_payment(Request $request)
    {
         PlannedPayment::create($request->all());
         return response()->json(['success'=>'Payment Added Successfully!.']); 
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
                $paymentDate =date('Y-m-d', strtotime($end. ' + 15 days'));
                
                $regionName = $value1->first()->region_name;
                if (!in_array($key, $array1)) {
                    array_push($array1, $key);
                    $statementvalue = $value1->sum('quantity') * $productPrice;
                    $array2 = [
                        'start' => $start,
                        'end'   => $end,
                        'paymentDate' => $paymentDate,
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


        return view('admin.sale.weeklySales', compact('resultant'));
    }
    public function reports(Request $request)
    {
        if ($request->ajax()) {
            $nilai = DB::table('product_orders')->distinct()->pluck('user_id');
            $data = User::whereIn('id',$nilai)->get();
            return Datatables::of($data) 
                ->addIndexColumn()
                ->addColumn('action', function(User $data){
                    $btn = '<a href="generate-pdf/'.$data->id.'" class="btn btn-sm btn-info">View</a>';
                    return $btn; 
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.customer.report');
    }

    public function getplannedPayments(Request $request)
    {
        
         if ($request->ajax()) {
            $plannedPayments=PlannedPayment::all();
            return Datatables::of($plannedPayments)->addIndexColumn()
            ->addColumn('name', function($row){
                $name = User::where('id',$row->customer_id)->first()->name;
                return $name;
            })
            ->rawColumns(['name'])
            ->make('true');
        }
         return view('admin.customer.plannedPayments');
    }

        //  fputcsv($handle, [   
        //     "Name",
        //     "statementPrice",
        //     'start',
        //     'end',
        //     'AccountNumber',
        //     'AthorityNumber'
        // ]);

        // //adding the data from the array
        // foreach ($resultant as $each_user) {
        //     fputcsv($handle, [
        //         $each_user['id'],
        //         $each_user['statementPrice'],
        //         $each_user['start'],
        //         $each_user['end'],
        //         $each_user['account_number'],
        //         $each_user['athority_number']
        //     ]);

        // }
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
                    $userdata=User::whereId($value1->user_id)->first();
                    $array2 = [
                        'start' => $startDate,
                        'end'   => $endDate,
                        'id' => $value1->user_id,
                        'name' =>$userdata->name,
                        'athority_number' =>$userdata->athority_number,
                        'account_number' =>$userdata->account_number,
                        'region' => $regionName,
                        'statementPrice' => $statementvalue,
                    ];
                    array_push($resultant, $array2);
                } else {
                    $statementPrice = $value1->quantity * $productPrice;
                    foreach ($resultant as $key => $value) {
                        if ($value['id'] == $value1->user_id) {
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
            
            "Record Type ",
            "Other Party Bank Account Number",
            'Transaction code',
            'Transaction Amount',
            'Other Party Name',
            'Other Party Code',
            'Other Party Reference',
            'Other Party Alpha Reference',
            'Your Name',
            'Your Code',
            'Your Reference',
            'Your Particulars',
        ]);
        fputcsv($handle, [
            1,
            '',
            '',
            '',
            Setting::where('name','Debit_Authority_Number')->first()->value,
            6,
            50929,
            '50923',
             '',
             Setting::where('name','Debit_Authority_Number')->first()->value,
             '',
             '',
        ]);
        $total =0;
        $count =0;
        //adding the data from the array
        foreach ($resultant as $each_user) {
           
            $count +=1;
            fputcsv($handle, [
                2,
                $each_user['account_number'],
                 00,
                $each_user['statementPrice'],
                $each_user['name'],
                $each_user['athority_number'],
                'Monthly DD',
                 '',
                 'ACME INC',
                 '',
                 'Monthly DD',
                 "",
            ]);
           
            $total += $each_user['statementPrice'];

        }
        fputcsv($handle, [
            3,
            Setting::where('name','Debit_Authority_Number')->first()->value,
             $count,
             $total,
            '',
            '',
             '',
             '',
             '',
             '',
             '',
             '',
        ]);
        fclose($handle);

        //download command
        return Response::download($filename, "download.csv", $headers);
    }
    
    public function customerOwingReport()
    {
        $products = Product::all();
        $users = User::role('Customer')->get(); 
        $supper =array();
        foreach ($users as $key => $value) {
            $userName=CustomerDetail::whereUserId($value->id)->first()->delivery_name;
            $userId = $value->id;
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
                        $start = $date->startOfWeek()->format('d/m');
                        $end = $date->endOfWeek()->format('d/m');
                        $start1 = $date->startOfWeek()->format('d-m-Y');
                        $end1 = $date->endOfWeek()->format('d-m-Y');
                        if(!in_array($key,$array1))
                        {
                                array_push($array1,$key);
                                $statementvalue=$value1->sum('quantity')*$productPrice;
                                $array2= [
                                    'start' => $start,
                                    'end'   => $end,
                                    'userId' => $userId,
                                    'start1' => $start1,
                                    'end1'   => $end1,
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
    


               
      return view('admin.customer.customerOwingReport',compact('supper'));
    }
    public function getplannedcsv()
    {
        // $plannedPayments=PlannedPayment::orderBy('date','desc')->groupBy(function($data){
        //     return $data->date;
        // })->get();
        // dd($plannedPayments);
      
        //   dd("hjdjd");
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
            
            "Export",
            "Date",
            'Total',
            'Customer',
            'Amount',
        ]);
        $total =0;
        $count =0;
        //adding the data from the array
        
            $plannedPayments= DB::table('planned_payments')->select(DB::raw('sum(amount) as amount'),'date')
            ->groupBy('date')->orderBy('date','desc')->get()->toArray();
            $array1 =array();
            foreach ($plannedPayments as $st) {
                $planned=PlannedPayment::where('date',$st->date)->get()->toArray();
                    foreach($planned as $key => $value) {
                        $name=User::where('id',$value['customer_id'])->first()->name;
                      
                       if(!in_array($st->date,$array1))
                       {
                        array_push($array1,$st->date);
                       }
                       else
                       {
                        $st->date='';
                        $st->amount='';
                       }
                        fputcsv($handle, [
                            'CSV File',
                            $st->date,
                            $st->amount,
                            $name,
                            $value['amount'],
                        ]);             
                    }
                
            }

        
       
        fclose($handle);

        //download command
        return Response::download($filename, "download.csv", $headers);
    }
}
