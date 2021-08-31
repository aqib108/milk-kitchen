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
            $data = ProductOrder::orderBy('id','DESC')->get();
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
                    $btn = '<a href="'.route('order.detail', $data->id).'" class="btn btn-primary btn-sm"> Detail </a>';
                    return $btn;
                })
                ->rawColumns(['action','productName'])
                ->make(true);
        }
        return view('admin.orders.index');
    }

    public function show($id)
    {
        $order = ProductOrder::findOrFail($id);
        if ($order == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }
        
        return view('admin.orders.detail',compact('order'));
    }
}
