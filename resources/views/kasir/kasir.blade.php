@extends('layouts.app')

@section('title')
Kasir
@endsection

@section('content')
<body>
<h2 class="text-center my-1">Pembelian Barang</h2>

<div class="row mt-3">
    <div class="col-lg-4 bg-white">
        <div class="box box-widget my-3">
            <div class="box-body">
                <table width="100%">
                    <tr>
                        <td style="vertical-align:top">
                            <label for="date" class="font-weight-bold">Tanggal</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="date" id="date" value="<?=date('y-m-d')?>" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">
                            <label for="user" class="font-weight-bold">Kasir</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" id="user" value="<?=Auth::user()->name?>" class="form-control" readonly>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">
                            <label for="customer" class="font-weight-bold">Pembeli</label>
                        </td>
                        <td>
                            <div>
                                <select id="pembeli" class="form-control" name="nama_pembeli">
                                <option>-- Pilih Pembeli --</option>
                                @foreach($data_pembelis as $pembeli)
                                {{$loop->iteration}}
                                    <option value="{{$pembeli->id}}">{{$pembeli->nama_pembeli}}</option>
                                @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4 bg-white">
        <div class="box box-widget my-3">
            <div class="box-body">
            <form action="/kasir/tambah_barang">
                <table width="100%">
                    <tr>
                    <td style="vertical-align:top: width:30%">
                            <label for="kode_barang" class="font-weight-bold">Kode Barang</label>
                        </td>
                        <td>
                            <div class="form-group input-group">
                                <input type="hidden" id="stok_barang_id">
                                <input type="hidden" id="harga_jual">
                                <input type="hidden" id="jumlah_barang">
                                <input type="text" id="barcode" class="form-control" autofocus>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">
                            <label for="jumlah" class="font-weight-bold">Jumlah</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" id="jumlah" value="1" min="1" class="form-control">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div action="/kasir/stok_barang/tambah">
                                <button type="submit" id="add_cart" class="btn btn-primary">
                                    <i class="fa fa-cart-plus mr-2"></i> Tambah
                                </button>
                            </div>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4 bg-white">
        <div class="box box-widget my-3">
            <div class="box-body">
                <div align="right">
                    <h4>Total Pembelian</h4>
                    <h1><b><span id="grand_total2" style="font-size:50pt">0</span></b></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row my-2 bg-white">
    <div class="col-lg-12 mt-3">
        <div class="box box-widget">
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Harga Barang</th>
                            <th style="width: 200px;">Total</th>
                            <th style="width: 10px;"></th>
                        </tr>
                    </thead>
                    <tbody id="cart_table">
                    <td colspan="9" class="text-center">--</td>
                        <tr>
                            @foreach ($riwayat_pembelians as $riwayat)
                        <tr>
                            <td> {{ $loop->iteration }} </td>
                            <td> {{ $riwayat->kode_barang }} </td>
                            <td> {{ $riwayat->nama_barang }} </td>
                            <td>
                                <div>
                                    @if ($riwayat->jumlah_barang > 1)
                                    <span class="btn btn-danger btn-sm" wire:click="decrement({{$riwayat->id}})">-</span>
                                    @endif
                                    <input type="text" class="form-control qty col-lg-4 my-2" value="{{ $riwayat->jumlah_barang }}" readonly>
                                    <span class="btn btn-success btn-sm" wire:click="increment({{$riwayat->id}})">+</span>
                                </div>
                            </td>
                            <td>Rp. {{ number_format($riwayat->harga_barang)}} </td>
                            <td>Rp. {{ number_format($riwayat->harga_barang*$riwayat->jumlah_barang)}} </td>
                            <td>
                                <button type="button" wire:click="deleteTransaction({{$riwayat->id}})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 bg-white">
        <div class="box box-widget my-3">
            <div class="box-body">
                <table width="100%">
                    <tr>
                        <td style="vertical-align:top: width:30%">
                            <label for="dibayar"  class="font-weight-bold">Bayar</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" id="dibayar" value="0" min="0" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">
                            <label for="kembali"  class="font-weight-bold">Kembali</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" id="kembali" value="0" min="0" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">
                            <label for="sisa"  class="font-weight-bold">Sisa</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" id="sisa" value="0" min="0" class="form-control">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-3 bg-white">
        <div class="box box-widget my-3">
            <div class="box-body">
                <table width="100%">
                    <tr>
                        <td style="vertical-align:top">
                            <label for="catatan" class="font-weight-bold">Catatan</label>
                        </td>
                        <td>
                         <div>
                            <textarea id="catatan" rows="3" class="form-control"></textarea>
                         </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div>
            <button id="cancel_payment" class="btn btn-flat btn-warning">
                <i class="fa fa-refresh mr-2"></i> Batal
            </button><br><br>
            <button id="process_payment" class="btn btn-flat btn-lg btn-success">
                <i class="fa fa-paper-plane-o mr-2"></i> Proses Pembelian
            </button>
        </div>
    </div>
</div>
</body>
@endsection