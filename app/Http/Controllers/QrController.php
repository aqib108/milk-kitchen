<?php

namespace App\Http\Controllers;

use App\Mail\CustomerMail;
use Mail;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\Models\Pod;

class QrController extends Controller
{
  public function driverScan($id)
  {
    $customerID = $id;
    $customer = User::find($customerID);
    if ($customerID == $customer->id) {
      return view('admin.driver-scan', compact('customerID'));
    }
  }

  public function driverCode(Request $request)
  {
    $customerID = $request->customer_id;
    $digit1 = $request->digit_1;
    $digit2 = $request->digit_2;
    $digit3 = $request->digit_3;
    $digit4 = $request->digit_4;
    $driverCode = $digit1 . $digit2 . $digit3 . $digit4;
    $driver = User::where('driver_code', $driverCode)->first();
    $driverId = $driver->id;
    if (isset($driver->driver_code) && ($driver->driver_code == $driverCode)) {
      return redirect()->route('qr.upload', [$customerID, $driverId]);
    } else {
      return redirect()->back()->with('error', 'Incorrect Code.Please try again!');
    }
  }

  public function driverUploadView($id, $driverId)
  {
    $customer = User::where('id', $id)->first();
    $driverId = $driverId;
    session()->put(['driverId' => $driverId, 'customerId' => $customer->id]);
    if ($customer != null) {
      return view('admin.driver-upload-file', compact('customer', 'driverId'));
    }
  }

  public function driverUploadViewCap()
  {
     $customerID= session()->get('customerId');
      $customer=User::whereId($customerID)->first();
    $productData = [
      'customer_id' => $customerID,
      'driver_id' => session()->get('driverId'),
    ];
    $product = Pod::create($productData);
    if (request()->image_url != NULL || request()->has('image_url')) {
      $productImageDirectory = 'pod';
      if (request()->hasFile('image_url')) {
        $fileName = request()->file('image_url')->getClientOriginalName();
        if (!Storage::exists($productImageDirectory)) {
          Storage::makeDirectory($productImageDirectory);
        }
        $imageUrl = Storage::putFile($productImageDirectory, new File(request()->file('image_url')));
        $product->update(['image_url' => $imageUrl]);
      $customer=  Pod::whereCustomerId($customerID)->first();
        Mail::to($customer->email)->send(new CustomerMail($customer));
      }

    }
   return response()->json("file Uploaded Successfully");
  }
}
