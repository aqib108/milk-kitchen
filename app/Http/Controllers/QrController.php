<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class QrController extends Controller
{
  public function driverScan($id)
  {
    $customerID = $id;
    $customer = User::find($customerID);
    if($customerID == $customer->id){
      return view('admin.driver-scan',compact('customerID'));
    }
  }

  public function driverCode(Request $request)
  {
    $customerID = $request->customer_id;
    $digit1 = $request->digit_1;
    $digit2 = $request->digit_2;
    $digit3 = $request->digit_3;
    $digit4 = $request->digit_4;
    $driverCode = $digit1.$digit2.$digit3.$digit4;
    $driver = User::where('driver_code',$driverCode)->first();
    if(isset($driver->driver_code) && ($driver->driver_code == $driverCode)){
      return redirect()->route('qr.upload',$customerID);
    }else{
      return redirect()->back()->with('error', 'Incorrect Code.Please try again!');
    }
  }

  public function driverUploadView($id)
  {
    $customer = User::where('id',$id)->first();
    if($customer != null){
      return view('admin.driver-upload-file',compact('customer'));
    }
  }

  public function driverUploadViewCap(Request $request, $id)
  {
   dd('okay');
  }
    
}
