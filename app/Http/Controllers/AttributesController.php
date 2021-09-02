<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AttributeRequest;
use App\Repositories\AttributeRepository;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;


class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Attribute::orderBy('id','DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function(Attribute $data){
                    if($data != null){
                        $name = $data->product->name;
                    }else{
                       $name = "----";
                    }
                    return $name;
                })
                ->addColumn('description', function(Attribute $data){

                    $str = Str::limit($data->description, 100, '...');
                    $description = strip_tags($str);
                    return $description;

                })
                ->addColumn('status', function(Attribute $data){
                    if($data->status == 1){
                        $status = '<span class="badge badge-success">Active</span>';
                    }
                    else{
                        $status = '<span class="badge badge-danger">Inactivate</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function(Attribute $data){
                    $btn1 = '<a onclick="deleteAttribute('.$data->id.')" href="javascript:void(0)" class="btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<a href="'.route('attribute.edit',$data->id).'" class="btn btn-sm btn-primary" >Edit</a>';
                    if($data->status == 1){
                        $status = '<a onclick="changeStatus('.$data->id.',0)" href="javascript:void(0)" class="btn btn-sm btn-danger" style ="margin-top:5px;">Inactivate</a>';
                    }
                    else{
                        $status = '<a onclick="changeStatus('.$data->id.',1)" href="javascript:void(0)" class="btn btn-sm btn-success" style ="margin-top:5px;">Activate</a>';
                    }

                    return $btn1.' '.$btn2.' '.$status;
                })
                ->rawColumns(['action','status','name','description'])
                ->make(true);
        }
        return view('admin.attributes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status','1')->orderBy('name','asc')->get();
        return view('admin.attributes.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        $attributesData = [
            'product_id' => $request->input('product_id'),
            'size' => $request->input('size'),
            'quantity' => $request->input('quantity'),
            'sku' => $request->input('sku'),
            'description' => $request->input('description'),
        ];

        $attribute = Attribute::create($attributesData);

        return redirect()->route('attribute.index')->with('success', 'Record added successfully.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        if ($attribute == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }

        $products = Product::where('status','1')->orderBy('name','asc')->get();

        return view('admin.attributes.edit',compact('attribute','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, $id)
    {
        $attribute = Attribute::findOrFail($id);

        $data = [
            'product_id' => $request->input('product_id'),
            'size' => $request->input('size'),
            'quantity' => $request->input('quantity'),
            'sku' => $request->input('sku'),
            'description' => $request->input('description'),
        ];

        $attribute->update($data);

        return redirect()->route('attribute.index')->with('success', 'Record updated successfully.');
        
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
            $attribute = Attribute::findOrFail((int)$request->id);
            if ($attribute == null) {
                return redirect()->back()->with('error', 'No Record Found To Delete.');
            }

            $attribute->delete();
            return response()->json(['status' => 1, 'message' => 'Record deleted successfully.']);

        } catch (\Throwable $th) {
            return response()->json(['error' => 1, 'message' => 'The record could not be deleted.']);
        }
    }

    public function status(Request $request)
    {
        $attribute = Attribute::findOrFail($request->id);
        if ($attribute == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }
        $attribute->update(['status'=> $request->input('status')]);
        $status = $attribute->status;
        return response()->json(['status'=>$status,'message'=>'Status Changed Successfully']);

    }
}
