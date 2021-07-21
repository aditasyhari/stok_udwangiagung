<?php

namespace App\Http\Controllers;

use App\data_pembeli;
use App\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index()
    {
        $data_pembelis = DB::table('data_pembelis')->paginate(5);
        

        return view('/keuangan/data_pembeli',['data_pembelis' => $data_pembelis]);
    }

    public function tambah()
    {
        return view('/keuangan/tambahpembeli');
    }

    public function simpan_pembeli()
    {
        $this->validate(request(),[
            'nama_pembeli'=>'required',
            'alamat_pembeli'=>'required' ,
            'nomor_hp'=>'required',
            'email_pembeli'=>'required'
        ]);

        $data=request()->all();
        $table=new data_pembeli();
        $table->nama_pembeli=$data["nama_pembeli"];
        $table->alamat_pembeli=$data["alamat_pembeli"];
        $table->nomor_hp=$data["nomor_hp"];
        $table->email_pembeli=$data["email_pembeli"];

        $table->save();

        session()->flash('success', 'data berhasil disimpan');

        return redirect('/keuangan/data_pembeli');
    }

    public function cari(Request $request)
    {
	// menangkap data pencarian
	$cari = $request->cari;
 
 	// mengambil data dari table pegawai sesuai pencarian data
	$data_pembeliss = DB::table('data_pembelis')
	->where('nama_pembeli','like',"%".$cari."%")
	->paginate();
 
    	// mengirim data pegawai ke view index
        return view('/keuangan/data_pembeli',['data_pembelis' => $data_pembelis]);
 
    }

    public function hapus($id)
    {
        $data=data_pembeli::find($id);

        $data->delete();

        session()->flash('success', 'data berhasil dihapus');

        return redirect('/keuangan/data_pembeli');
    }

    public function riwayat($id)
    {
        $pembeli = data_pembeli::find($id);
        return view('keuangan.riwayat', compact(['pembeli']));
    }

    public function detail_riwayat($id_pembeli, $id_riwayat)
    {
        $pembeli = data_pembeli::find($id_pembeli);
        $riwayat = Riwayat::find($id_riwayat);
        
        return view('keuangan.detail-riwayat', compact(['pembeli', 'riwayat']));
    }

    public function update_riwayat(Request $request, $id_riwayat) {
        $riwayat = Riwayat::find($id_riwayat);
        $dibayar = $riwayat->dibayar + $request->bayar_hutang;

        $riwayat->update([
            'catatan' => $request->catatan,
            'dibayar' => $dibayar,
            'hutang' => $request->hutang
        ]);

        return back()->with('status', 'Data berhasil diperbarui !!');
    }

    public function ubah_pembeli($id)
    {
    return view('keuangan.ubah_pembeli')->with('pembeli', data_pembeli::find($id));
    }

    public function update_pembeli($id)
    {
        $this->validate(request(),[
            'nama_pembeli'=>'required',
            'alamat_pembeli'=>'required' ,
            'nomor_hp'=>'required',
            'email_pembeli'=>'required' 
        ]);

        $data=request()->all();
        $table=data_pembeli::find($id);
        $table->nama_pembeli=$data["nama_pembeli"];
        $table->alamat_pembeli=$data["alamat_pembeli"];
        $table->nomor_hp=$data["nomor_hp"];
        $table->email_pembeli=$data["email_pembeli"];

        $table->save();

        session()->flash('success', 'data berhasil diupdate');

        return redirect('/keuangan/data_pembeli');
    }
}
