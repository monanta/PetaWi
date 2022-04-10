<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetaWB;
use DataTables;

class petawbController extends Controller
{
    public function index()
    {
        return view('petawb');
        $data = PetaWB::all();
        return $data->toArray();
    }
    public function petawbApi()
    {
        $data = PetaWB::all();
        return $data->toJSON();
    }

    public function tabel()
    {
        $data = PetaWB::get();
        return Datatables::of($data)->make(true);
    }
}
