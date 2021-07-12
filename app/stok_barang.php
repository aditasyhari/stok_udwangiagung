<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stok_barang extends Model
{
    protected $table = 'stok_barangs';

    protected $primaryKey = 'id';

    protected $fillable = [
    	'tanggal',
        'asal_barang',
    	'nama_barang',
        'jumlah_barang',
        'harga_jual',
    	'harga_beli',
        'kode_barang',
    	'user_id'
    ];
    
    // Tambahkan fungsi ini untuk merelasikan ke model riwayat_pembelian.
    public function riwayat_pembelians()
    {
        return $this->hasMany('App/riwayat_pembelian');
    }

    public function user()
    {
        return $this->belongsTo('App\user');
    }
}