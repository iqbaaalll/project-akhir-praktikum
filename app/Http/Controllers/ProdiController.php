<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProdiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getProdi()
    {
        $prodi = Prodi::get(['id', 'nama']);

        return response()->json([
            'prodi' => $prodi,
        ], 200);
    }

    //
}
