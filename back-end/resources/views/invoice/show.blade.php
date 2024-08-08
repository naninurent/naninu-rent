@extends('layouts.app')
@section('title','Buat Invoice')
@section('content')
<div class="container pt-3">
    <div class="form-group my-3">
        <a class="btn btn-primary" href="{{url("manage_orders")}}">Kelola Order</a>
    </div>
    <form action="{{url('create_invoice')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row pt-2">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="invoice" class="form-label">No Invoice</label>
                    <input type="hidden" name="invoice" id="invoice" class="form-control" value="{{$order->invoice}}">
                    <input type="text" name="invoice-2" id="invoice-2" class="form-control" value="{{$order->invoice}}" disabled>
                </div>
                <div class="form-group mb-3">
                    <label for="nopol" class="form-label">No Polisi</label>
                    <input type="text" name="nopol" id="nopol" class="form-control" value="{{$order->nopol}}" disabled>
                </div>
                <div class="form-group mb-3">
                    <label for="type" class="form-label">Unit</label>
                    <input type="text" name="type" id="type" class="form-control" value="{{$order->type}}" disabled>
                </div>

                <div class="form-group mb-4">
                    <label for="harga" class="form-label">Harga</label>
                    <?php
                    if ($order->layanan == "Mobil Saja") {
                        $harga = $order->harga;
                    } else if ($order->layanan == "Dengan Supir") {
                        $harga = $order->harga + 350000;
                    } else {
                        $harga = $order->harga + 950000;
                    }

                    ?>
                    <input type="number" name="harga" id="hargasewa" class="form-control" value="{{$harga}}">
                </div>
                <input class="d-none" type="number" name="harga" value="{{$order->harga}}">
                <div class="form-group mb-3">
                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" value="{{$order->nama}}" disabled>
                </div>
                <div class="form-group mb-3">
                    <label for="tujuan" class="form-label">Tujuan</label>
                    <input type="text" name="tujuan" id="tujuan" class="form-control" value="{{$order->tujuan}}" disabled>
                </div>

                <div class="form-group mb-3">
                    <label for="tgl_sewa" class="form-label">Tanggal Sewa</label>
                    <input type="date" name="tgl_sewa" id="tgl_sewa" class="form-control" value="{{$order->mulai_sewa}}" disabled>
                </div>
                <div class="form-group mb-3">
                    <label for="selesai_sewa" class="form-label">Selesai Sewa</label>
                    <input type="date" name="selesai_sewa" id="selesai_sewa" class="form-control" value="{{$order->selesai_sewa}}" oninput="hitung_lama_sewa()" disabled>
                </div>
                <div class="form-group mb-3">
                    <label for="lama_sewa" class="form-label">Lama Sewa</label>
                    <input type="number" name="lama_sewa" class="lama_sewa form-control" value="{{$order->lama_sewa}}" oninput="hitung_harga_edit()" disabled>
                    <p id="lama_sewa" class="mt-3 d-none">{{$order->lama_sewa}}</p>
                </div>
                <div class="form-group mb-3">
                    <label for="overtime" class="form-label">Overtime</label>
                    <input type="number" name="overtime" id="overtime" class="form-control" value="{{$order->overtime}}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{$order->tanggal}}" >
                </div>
                <div class="form-group mb-3">
                    <label for="user" class="form-label">Nama User</label>
                    <input type="text" name="user" id="user" class="form-control" value="{{$order->user}}">
                </div>
                <div class="form-group mb-3">
                    <label for="driver" class="form-label">Nama Driver</label>
                    <input type="text" name="driver" id="driver" class="form-control" value="{{$order->driver}}">
                </div>
                <div class="form-group mb-3">
                    <label for="uang_makan" class="form-label">Uang Makan</label>
                    <input type="number" name="uang_makan" id="uang_makan" class="form-control" value="{{$order->uang_makan}}">
                </div>
                <div class="form-group mb-3">
                    <label for="penginapan" class="form-label">Penginapan</label>
                    <input type="number" name="penginapan" id="penginapan" class="form-control" value="{{$order->penginapan}}">
                </div>
                <div class="form-group mb-3">
                    <label for="bbm" class="form-label">BBM</label>
                    <input type="number" name="bbm" id="bbm" class="form-control" value="{{$order->bbm}}">
                </div>
                <div class="form-group mb-3">
                    <label for="tol" class="form-label">TOL</label>
                    <input type="number" name="tol" id="tol" class="form-control" value="{{$order->tol}}">
                </div>
                <div class="form-group mb-3">
                    <label for="parkir" class="form-label">Parkir</label>
                    <input type="number" name="parkir" id="parkir" class="form-control" value="{{$order->parkir}}">
                </div>
                <div class="form-group mb-3">
                    <label for="steam" class="form-label">Cuci Steam</label>
                    <input type="number" name="steam" id="steam" class="form-control" value="{{$order->steam}}">
                </div>
                <div class="form-group mb-3">
                    <label for="nitrogen" class="form-label">Nitrogen</label>
                    <input type="number" name="nitrogen" id="nitrogen" class="form-control" value="{{$order->nitrogen}}">
                </div>
                <div class="form-group mb-3">
                    <label for="total_invoice" class="form-label">Total Harga Invoice</label>
                    <input type="number" name="total_invoice" id="total_invoice" class="form-control" value="{{$order->harga_invoice}}">
                </div>

                <div class="form-group mb-3">
                    <button type="button" class="btn btn-primary" id="hitung_total" onclick="hitungTotal()">Hitung Total</button>
                    <button type="button" class="btn btn-warning" id="hitung_pajak" >Hitung Pajak</button>
                </div>

                <div class="form-group my-3">
                    <button type="submit" name="tambah" class="btn btn-success w-100 simpan" disabled>Simpan</button>
                </div>
            </div>
        </div>
    </form>

</div>
<script src="{{asset("js/app.js")}}"></script>
@endsection