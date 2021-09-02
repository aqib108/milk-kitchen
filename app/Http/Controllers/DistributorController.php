<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;
use App\Http\Requests\DistributorRequest;
use Yajra\DataTables\DataTables;
use Validator;
class DistributorController extends Controller
{

    public function checkEmail(Request $request)
    {
        $input = $request->only(['email']);

        $request_data = [
            'email' => 'required|email|unique:distributors,ends_with:.com',
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
                'message' => "<span style='color:#95d60c;'>The email is available"
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
        $data = Distributor::orderBy('id','DESC')->get();
        if ($request->ajax()) {
            $data = Distributor::orderBy('id','DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function(Distributor $data){
                    if($data->status == 1){
                        $status = '<span class="badge badge-success">Active</span>';
                    }
                    else{
                        $status = '<span class="badge badge-danger">Inactivate</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function(Distributor $data){
                    $btn1 = '<a data-id="'.$data->id.'" data-tab="distributors" data-url="distributor/delete" 
                    href="javascript:void(0)" class="del_btn btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<a href="'.route('distributor.edit', $data->id).'" class="btn btn-sm btn-primary" >Edit</a>';
                     //$btn3 = '<a href="'.route('distributor.detail', $data->id).'" class="btn btn-primary btn-sm"> Detail </a>';
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
        return view('admin.distributor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.distributor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Distributor::create($request->all());
        if($data->wasRecentlyCreated){
            $response = array(
                'data' => [],
                'message' => 'Data Successfully Added',
                'status' => 'success',
            );
            return $response;
        }
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
        $distributor = Distributor::findOrFail($id);
        if ($distributor == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }

        return view('admin.distributor.edit',compact('distributor'));
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
        $product = Distributor::find($id)->update($request->all());
        return redirect()->route('distributor.index')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Distributor::findOrFail($id);
        $product->delete();
        return response()->json(array(
            'data' => true,
            'message' => 'Distributor Successfully Deleted',
            'status' => 'success',
        ));
    }
    public function status(Request $request)
    {
        $distributor = Distributor::findOrFail($request->id);
        if (empty($distributor)) {
            return redirect()->back()->with('error', 'No Record Found.');
        }
        $distributor->update(['status'=> $request->input('status')]);
        $status = $distributor->status;
        return response()->json(['status'=>$status,'message'=>'Status Changed Successfully']);
    }
}
