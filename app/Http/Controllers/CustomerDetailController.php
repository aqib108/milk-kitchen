<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerDetailRequest;
use App\Repositories\CustomerDetailRepository;
use App\Models\CustomerDetail;
use App\Models\Country;
use Auth;

class CustomerDetailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
       public function getCities()
       {
          $cities= Country::where('name','like','%' . request()->city . '%')->get();
           return response()->json([
            'html' => view('customer.cities',compact('cities'))->render() ]);
       }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerDetailRequest $request)
    {
        
        $CustomerDetail =  [
            'user_id' => $request->input('user_id'),
            'business_name' => $request->input('business_name'),
            'business_address_1' => $request->input('business_address_1'),
            'business_address_2' => $request->input('business_address_2'),
            'business_country' => $request->input('business_country'),
            'business_region' => $request->input('business_region'),
            'business_city' => $request->input('business_city'),
            'business_phone_no' => $request->input('business_phone_no'),
            'business_email' => $request->input('business_email'),
            'business_contact_no' => $request->input('business_contact_no'),
            'delivery_name' => $request->input('delivery_name'),
            'delivery_address_1' => $request->input('delivery_address_1'),
            'delivery_address_2' => $request->input('delivery_address_2'),
            'delivery_country' => $request->input('delivery_country'),
            'delivery_region' => $request->input('delivery_region'),
            'delivery_zone' => $request->input('delivery_zone'),
            'delivery_city' => $request->input('delivery_city'),
            'delivery_notes' => $request->input('delivery_notes'),
        ];

        $customerDetail = CustomerDetail::create($CustomerDetail);

        return response()->json(['success'=>'Your Record Added Successfully!.', 'customerDetail'=>$customerDetail]);  
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerDetailRequest $request,$id)
    {
        
        $customerDetail = CustomerDetail::where('user_id',$id)->update([
            'business_name' => $request->input('business_name'),
            'business_address_1' => $request->input('business_address_1'),
            'business_address_2' => $request->input('business_address_2'),
            'business_country' => $request->input('business_country'),
            'business_region' => $request->input('business_region'),
            'business_city' => $request->input('business_city'),
            'business_phone_no' => $request->input('business_phone_no'),
            'business_email' => $request->input('business_email'),
            'business_contact_no' => $request->input('business_contact_no'),
            'delivery_name' => $request->input('delivery_name'),
            'delivery_address_1' => $request->input('delivery_address_1'),
            'delivery_address_2' => $request->input('delivery_address_2'),
            'delivery_country' => $request->input('delivery_country'),
            'delivery_region' => $request->input('delivery_region'),
            'delivery_zone' => $request->input('delivery_zone'),
            'delivery_city' => $request->input('delivery_city'),
            'delivery_notes' => $request->input('delivery_notes'),
        ]);

        return response()->json(['success'=>'Your Record Successfully Updated!.']);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
