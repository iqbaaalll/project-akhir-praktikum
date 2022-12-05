<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;

class MatakuliahController extends Controller
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

    public function getMatakuliah()
    {
        $matakuliah = Matakuliah::get(['id', 'nama']);

        return response()->json([
            'matakuliah' => $matakuliah,
        ], 200);
    }
    //
}
