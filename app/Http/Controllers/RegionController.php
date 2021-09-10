<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegionRequest;
use App\Models\Region;


class RegionController extends Controller
{
    //
    public function __constructor()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $region = Region::all();
    }

    public function store(Request $request)
    {
        # code...
    }
}
