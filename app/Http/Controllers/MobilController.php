<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;

class MobilController extends Controller
{
    /**
     * List mobil untuk VISITOR & CUSTOMER
     */
    public function publicIndex()
    {
        $mobils = Mobil::where('deleted_at')->get();

        return view('customer.dashboard', compact('mobils'));
    }

    /**
     * List mobil untuk ADMIN
     */
    public function index()
    {
        $mobils = Mobil::all();

        return view('mobil.index', compact('mobils'));
    }
}