<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MahasiswaController extends Controller
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

    public function getMahasiswa()
    {
        $mahasiswa = Mahasiswa::get(['nim', 'nama', 'prodiId', 'angkatan']);

        return response()->json([
            'success' => true,
            'message' => 'Grabbed all mahasiswa',
            'mahasiswa' => $mahasiswa,
        ], 200);
    }   

    public function getMahasiswaByToken(Request $request)
    {
        // $mahasiswa = Mahasiswa::find($request->nim);
        // $prodi = Prodi::find($mahasiswa->prodiId);

        return response()->json([
            'success' => true,
            'message' => 'Grabbed mahasiswa by nim',
            'mahasiswa' => $request->user
            ]
        );
    }

    public function getMahasiswaByNim(Request $request)
    {
        $mahasiswa = Mahasiswa::find($request->nim);
        $prodi = Prodi::find($mahasiswa->prodiId);
        //$matakuliah = Matakuliah::get(['id', 'nama']);

        return response()->json([
            'success' => true,
            'message' => 'Grabbed mahasiswa by nim',
            'mahasiswa' => [
                    'nim' => $mahasiswa->nim,
                    'nama' => $mahasiswa->nama,
                    'prodi' => $prodi->nama,
                    'angkatan' => $mahasiswa->angkatan,
                    'matakuliah' => $mahasiswa->matakuliah,
            ],

        ]);
    }

    public function addMatakuliah(Request $request)
    {
        $mahasiswa = Mahasiswa::find($request->nim);

        if ($request->nim != $request->user->nim) {
            return response()->json([
                'success' => false,
                'message' => 'gabisa bang',
            ]);
        }

        $mahasiswa->matakuliah()->attach($request->mkId);

        return response()->json([
            'success' => true,
            'message' => 'Matakuliah added to mahasiswa',
        ]);
    }

    public function deleteMatakuliah(Request $request)
    {
        $mahasiswa = Mahasiswa::find($request->nim);

        if ($request->nim != $request->user->nim) {
            return response()->json([
                'success' => false,
                'message' => 'gabisa bang',
            ]);
        }

        $mahasiswa->matakuliah()->detach($request->mkId);

        return response()->json([
            'success' => true,
            'message' => 'Matakuliah deleted from mahasiswa',
        ]);
    }
    //
}
