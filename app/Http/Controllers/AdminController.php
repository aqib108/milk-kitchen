<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Distributor;
use App\Models\Driver;
use Validator;
use Session;

class AdminController extends Controller
{
    protected $userRepo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('auth');
        $this->userRepo = $userRepo;
    }
    
    public function index()
    {
        $user = Auth::user();
        return view('admin.index',compact('user'));
    }

    public function mangeDashBoard()
    {
        $count = array();
        $count['users'] = User::where('status', '=', '1')->count();
        $count['products'] = Product::where('status', '=', '1')->count();
        $count['distributor'] = Distributor::where('status', '=', '1')->count();
        $count['drivers'] = Driver::where('status', '=', '1')->count();

        return response()->json(['status' => true, 'count' => $count]);

    }

    /**
    *****************************************************************************
    ************************** Admin Password ***********************************
    *****************************************************************************
    */

    public function setting(Request $request)
    {
        if($request->isMethod('post')){
            dd($request->all());
        }
        return view('admin.setting');
    }

    public function checkPassword(Request $request)
    { 
        $user = Auth::user();
        $data = $request->all();
        if (Hash::check($data['current_password'],$user->password)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|min:6|max:32',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $data = $request->all();
        if (Hash::check($data['current_password'],$user->password)) {
            if ($data['new_password'] == $data['confirm_password']) {
                User::where('id',$user->id)->update(['password'=>bcrypt($data['new_password'])]);
               return redirect()->back()->with(['success' => 'Password Has Been Updated Successfully!']);
            } else {
               return redirect()->back()->with(['error' => 'New Password & Confirm Password NOT MATCH']);
            }
            
        } else {
           return redirect()->back()->with(['error' => 'Your Current Password is INCORRECT']);
        }
        return redirect()->back();
    }
}
