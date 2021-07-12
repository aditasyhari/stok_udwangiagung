<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModalController extends Controller
{
    public function grafik()
    {
        $modals = \App\modal::all();

        $categories = [];
        $data = [];

        foreach($modals as $modal){
            $categories[] = $modal->bulan;
            $data[] = $modal->modal;
        }

       //dd(json_encode($data));
        return view('/keuangan/grafik',['modals' => $modals, 'categories' => $categories, 'data' => $data]);
    }

    public function tambah(Request $request)
    {
        \App\modal::create($request->all());
        return redirect('/keuangan/grafik')->with('sukses','Modal Berhasil Ditambahkan');
    }

    public function hapus()
    {
        DB::table('modals')->delete();
        return redirect('/keuangan/grafik');
    }
}
