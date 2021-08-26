<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Models\Product;
use App\Models\Distributor;
use App\Models\Driver;

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
        return view('admin.index');
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

    


}
