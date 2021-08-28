<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductOrder;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductOrder::with('WeekDay')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('productName', function(ProductOrder $data){
                    $name = $data->product->name;
                    return $name;
                })
                ->addColumn('customerName', function(ProductOrder $data){
                    $name = $data->user->name;
                    return $name;
                })
                ->addColumn('action', function(ProductOrder $data){
                    $btn = '<a href="" class="btn btn-primary btn-sm"> Detail </a>';
                    return $btn;
                })
                ->rawColumns(['action','productName'])
                ->make(true);
        }
        return view('admin.orders.index');
    }
}
