<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;
use App\Models\Product;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::orderBy('id','DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function(Product $data){
                    if($data->status == 1){
                        $status = '<span class="badge badge-success">Active</span>';
                    }
                    else{
                        $status = '<span class="badge badge-danger">Inactivate</span>';
                    }
                    return $status;
                })
                ->addColumn('new', function(Product $data){
                    if($data->new == 1){
                        $status = '<i class="fa fa-check" style="color:#95d60c;" aria-hidden="true"></i>';
                    }
                    else{
                        $status = '<i class="fa fa-times" style="color:red;" aria-hidden="true"></i>';
                    }
                    return $status;
                })
                ->addColumn('active', function(Product $data){
                    if($data->active == 1){
                        $status = '<i class="fa fa-check" style="color:#95d60c;" aria-hidden="true"></i>';
                    }
                    else{
                        $status = '<i class="fa fa-times" style="color:red;" aria-hidden="true"></i>';
                    }
                    return $status;
                })
                ->addColumn('f_saleable', function(Product $data){
                    if($data->f_saleable == 1){
                        $status = '<i class="fa fa-check" style="color:#95d60c;" aria-hidden="true"></i>';
                    }
                    else{
                        $status = '';
                    }
                    return $status;
                })
                ->addColumn('r_saleable', function(Product $data){
                    if($data->r_saleable == 1){
                        $status = '<i class="fa fa-check" style="color:#95d60c;" aria-hidden="true"></i>';
                    }
                    else{
                        $status = '';
                    }
                    return $status;
                })
                ->addColumn('c_saleable', function(Product $data){
                    if($data->c_saleable == 1){
                        $status = '<i class="fa fa-check" style="color:#95d60c;" aria-hidden="true"></i>';
                    }
                    else{
                        $status = '';
                    }
                    return $status;
                })
                ->addColumn('action', function(Product $data){
                    $btn1 = '<a onclick="deleteProduct('.$data->id.')" href="javascript:void(0)" class="btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<a href="'.route('product.edit', $data->id).'" class="btn btn-sm btn-primary" >Edit</a>';
                    $btn3 = '<a href="'.route('product.detail', $data->id).'" class="btn btn-primary btn-sm"> Detail </a>';
                    if($data->status == 1){
                        $status = '<a onclick="changeStatus('.$data->id.',0)" href="javascript:void(0)" class="btn btn-sm btn-danger" style ="margin-top:5px;">Inactivate</a>';
                    }
                    else{
                        $status = '<a onclick="changeStatus('.$data->id.',1)" href="javascript:void(0)" class="btn btn-sm btn-success" style ="margin-top:5px;">Activate</a>';
                    }

                    return $btn1.' '.$btn2.' '.$btn3.' '.$status;
                })
                ->rawColumns(['action','status','new','active','f_saleable','r_saleable','c_saleable'])
                ->make(true);
        }
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $productData = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'sku' => $request->input('sku'),
            'new' => $request->input('new'),
            'pack_size' => $request->input('pack_size'),
            'active' => $request->input('active'),
            'f_ctn_price' => $request->input('f_ctn_price'),
            'f_bottle_price' => $request->input('f_bottle_price'),
            'f_saleable' => $request->input('f_saleable'),
            'r_ctn_price' => $request->input('r_ctn_price'),
            'r_bottle_price' => $request->input('r_bottle_price'),
            'r_saleable' => $request->input('r_saleable'),
            'c_ctn_price' => $request->input('c_ctn_price'),
            'c_bottle_price' => $request->input('c_bottle_price'),
            'c_saleable' => $request->input('c_saleable'),
        ];

        $product = Product::create($productData);

        if ($request->image_url != NULL || $request->has('image_url')) {
            
            $productImageDirectory = 'products';
            if ($request->hasFile('image_url')) {
                $fileName = $request->file('image_url')->getClientOriginalName();
                if(!Storage::exists($productImageDirectory)){
                    Storage::makeDirectory($productImageDirectory);
                }
                $imageUrl = Storage::putFile($productImageDirectory, new File($request->file('image_url')));
                $product->update(['image_url'=> $imageUrl]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Record added successfully.');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        if ($product == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }

        return view('admin.products.detail',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        if ($product == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }

        return view('admin.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product == null) {
            return redirect()->back()->with('error', 'No Record Found To Update.');
        }

        $data = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'sku' => $request->input('sku'),
            'new' => $request->input('new'),
            'pack_size' => $request->input('pack_size'),
            'active' => $request->input('active'),
            'f_ctn_price' => $request->input('f_ctn_price'),
            'f_bottle_price' => $request->input('f_bottle_price'),
            'f_saleable' => $request->input('f_saleable'),
            'r_ctn_price' => $request->input('r_ctn_price'),
            'r_bottle_price' => $request->input('r_bottle_price'),
            'r_saleable' => $request->input('r_saleable'),
            'c_ctn_price' => $request->input('c_ctn_price'),
            'c_bottle_price' => $request->input('c_bottle_price'),
            'c_saleable' => $request->input('c_saleable'),
        ];

        if ($request->image_url != NULL || $request->has('image_url')) {

            $productImageDirectory = 'products';
            if ($request->hasFile('image_url')) {
                $rules = [
                'image_url' => 'nullable|mimes:jpeg,jpg,png|max:10000',
                ];
                if(!Storage::exists($productImageDirectory)){
                    Storage::makeDirectory($productImageDirectory);
                }
                Storage::delete('/'.$product->image_url);
                $imageUrl = Storage::putFile($productImageDirectory, new File($request->file('image_url')));
                $data['image_url'] = $imageUrl;
            } 
        }

        $product->update($data);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $product = Product::findOrFail((int)$request->id);
            if ($product == null) {
                return redirect()->back()->with('error', 'No Record Found To Delete.');
            }

            $product->delete();
            return response()->json(['status' => 1, 'message' => 'Record deleted successfully.']);

        } catch (\Throwable $th) {
            return response()->json(['error' => 1, 'message' => 'The record could not be deleted.']);
        }
    }

    public function status(Request $request)
    {
        $product = Product::findOrFail($request->id);
        if ($product == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }
        $product->update(['status'=> $request->input('status')]);
        $status = $product->status;
        return response()->json(['status'=>$status,'message'=>'Status Changed Successfully']);
    }
}
