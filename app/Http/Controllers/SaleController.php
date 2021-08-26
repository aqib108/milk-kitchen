<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reoccurring(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::all(); 
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(Product $data){
                    $btn = '<a onclick="" href="javascript:void(0)" class="btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<a href="javascript::void(0);" class="btn btn-sm btn-primary" data-id="'.$data->id.'">Edit</a>';
                    return $btn.' '.$btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.sale.reoccurring');
    }
}
