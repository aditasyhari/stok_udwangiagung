@extends('layouts.app')

@section('title')
Detail Barang
@endsection

@section('content')

        <h1 class="text-center my-5">
            {{$stok->nama_barang}}
        </h1>
        
        <br/>
		<a href="" class="btn btn-primary" target="_blank">CETAK PDF</a>
		<table class='table table-bordered'>

        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                <th scope="col">Tanggal</th>
                <th scope="col">Asal Barang</th>
                <th scope="col">Jumlah Barang(kg)</th>
                <th scope="col">Harga Beli(kg)</th>
                <th scope="col">Harga Jual(kg)</th>
                <th scope="col">Kode Barang</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>{{$stok->tanggal}}</td>
                <td>{{$stok->asal_barang}}</td>
                <td>{{$stok->jumlah_barang}}</td>
                <td>@currency($stok->harga_beli)</td>
                <td>@currency($stok->harga_jual)</td>
                <td>{{$stok->kode_barang}}</td>
                </tr>
            </tbody>
        </table>
        <div>
        <a href="/stok/{{$stok->id}}/ubah" class="btn btn-primary">Ubah</a>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusdiagram">Hapus</button>

                <div class="modal fade" id="hapusdiagram" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Barang?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <a href="/stok/{{$stok->id}}/delete" class="btn btn-danger">Hapus</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                    </div>
                </div>
                </div>
        <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
        </div>

@endsection  