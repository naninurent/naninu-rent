@extends('layouts.app')
@section('title','Tambah Layanan')
@section('content')

    <div class="container d-flex justify-content-center">
        <div class="col-sm-4 mt-3">
        <h3 class="text-center">Tambah Layanan</h3>
        <form action="/services" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="" class="form-label">Layanan</label>
                <input type="text" class="form-control" name="layanan" id="layanan">
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga" id="harga">
            </div>
            <button class="btn btn-primary w-100" type="submit">Simpan</button>
        </form>
        </div>
    </div>

@endsection