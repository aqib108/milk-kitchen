<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use Validator;
use App\Http\Requests\DriverRequest;
use Yajra\DataTables\DataTables;
class DriverController extends Controller
{


    public function checkEmail(Request $request)
    {
        $input = $request->only(['email']);

        $request_data = [
            'email' => 'required|email|unique:drivers,email|ends_with:.com',
        ];

        $validator = Validator::make($input, $request_data);

        // json is null
        if ($validator->fails()) {
            $errors = json_decode(json_encode($validator->errors()), 1);
            return response()->json([
                'success' => false,
                'message' => array_reduce($errors, 'array_merge', array()),
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'The email is available'
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Driver::orderBy('id','DESC')->get();
        if ($request->ajax()) {
            $data = Driver::orderBy('id','DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function(Driver $data){
                    if($data->status == 1){
                        $status = '<span class="badge badge-success">Active</span>';
                    }
                    else{
                        $status = '<span class="badge badge-danger">Inactivate</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function(Driver $data){
                    $btn1 = '<a onclick="deleteDriver('.$data->id.')" href="javascript:void(0)" class="btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<a href="'.route('driver.edit', $data->id).'" class="btn btn-sm btn-primary" >Edit</a>';
                     //$btn3 = '<a href="'.route('driver.detail', $data->id).'" class="btn btn-primary btn-sm"> Detail </a>';
                    if($data->status == 1){
                        $status = '<a onclick="changeStatus('.$data->id.',0)" href="javascript:void(0)" class="btn btn-sm btn-danger" style ="margin-top:5px;">Inactivate</a>';
                    }
                    else{
                        $status = '<a onclick="changeStatus('.$data->id.',1)" href="javascript:void(0)" class="btn btn-sm btn-success" style ="margin-top:5px;">Activate</a>';
                    }

                    return $btn2.'  '.$status.' '.$btn1;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('admin.driver.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.driver.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(['kk']);
        $product = Driver::create($request->all());
       
        return redirect()->route('driver.index')->with('success', 'Record added successfully.');  
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
        $driver = Driver::findOrFail($id);
        if ($driver == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }
        return view('admin.driver.edit',compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Driver::find($id)->update($request->all());
        return redirect()->route('driver.index')->with('success', 'Record updated successfully.');
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
            $product = Driver::findOrFail((int)$request->id);
            if (empty($product)) {
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
        $product = Driver::findOrFail($request->id);
        if (empty($product)) {
            return redirect()->back()->with('error', 'No Record Found.');
        }
        $product->update(['status'=> $request->input('status')]);
        return response()->json(['status'=>'1','message'=>'Status Changed Successfully']);

    }
}
