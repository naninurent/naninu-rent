@extends('layouts.app')
@section('title','Ubah Layanan')
@section('content')

    <div class="container d-flex justify-content-center">
        <div class="col-sm-4 mt-3">
        <h3 class="text-center">Ubah Layanan</h3>
        <form action="{{url("service/$service->id")}}" method="POST">
            @method('PATCH')
            @csrf
            <div class="form-group mb-3">
                <label for="" class="form-label">Layanan</label>
                <input type="text" class="form-control" name="layanan" id="layanan" value="{{$service->layanan}}">
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga" id="harga" value="{{$service->harga}}">
            </div>
            <button class="btn btn-primary w-100 mb-3" type="submit">Simpan</button>
        </form>
        <form action="{{url("service/$service->id")}}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger w-100" type="submit" onclick="return confirm('Yakin Ingin Hapus ?')">Hapus</button>
        </form>
        </div>
    </div>

@endsection