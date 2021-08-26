<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerDetailRequest;
use App\Repositories\CustomerDetailRepository;
use App\Models\CustomerDetail;

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
            'business_country_id' => $request->input('business_country_id'),
            'business_region_id' => $request->input('business_region_id'),
            'business_city_id' => $request->input('business_city_id'),
            'business_phone_no' => $request->input('business_phone_no'),
            'business_email' => $request->input('business_email'),
            'business_contact_no' => $request->input('business_contact_no'),
            'delivery_name' => $request->input('delivery_name'),
            'delivery_address_1' => $request->input('delivery_address_1'),
            'delivery_address_2' => $request->input('delivery_address_2'),
            'delivery_country_id' => $request->input('delivery_country_id'),
            'delivery_region_id' => $request->input('delivery_region_id'),
            'delivery_city_id' => $request->input('delivery_city_id'),
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
    public function update(Request $request)
    {
        dd($request->all(),$id);
       
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
