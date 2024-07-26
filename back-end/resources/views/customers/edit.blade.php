@extends('layouts.app')
@section('title','Tambah Pelanggan')
@section('content')
<div class="container">
    <form action="{{url("customer/$customer->id")}}" method="POST" enctype="multipart/form-data">
        <div class="row pt-5">
            <div class="col-md-6">
                @method('PATCH')
                @csrf
                <div class="form-group mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" name="nik" id="nik" class="form-control" value="{{$customer->ktp}}" vrequired>
                </div>
                <div class="form-group mb-3">
                    <label for="nama" class="form-label">Nama Pelanggan</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{$customer->nama}}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="telp" class="form-label">No Telepon</label>
                    <input type="text" name="telp" id="telp" class="form-control" value="{{$customer->telp}}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{$customer->email}}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" required>{{$customer->alamat}}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success mb-3 mt-3">
                    <img src="{{asset("images/pelanggan/img_ktp/$customer->img_ktp")}}" class="img-fluid" width="100px" alt="">
                    <div class="card-header">
                        <div class="card-title">Ubah Foto KTP</div>
                    </div>
                    <input type="file" name="img_ktp" id="img_ktp" class="form-control">
                </div>
                <div class="card card-success mb-3">
                    <img src="{{asset("images/pelanggan/img_sim/$customer->img_sim")}}" class="img-fluid" width="100px" alt="">
                    <div class="card-header">
                        <div class="card-title">Ubah Foto SIM</div>
                    </div>
                    <input type="file" name="img_sim" id="img_sim" class="form-control">
                </div>
                <div class="card card-success mb-3">
                    <img src="{{asset("images/pelanggan/img_kk/$customer->img_kk")}}" class="img-fluid" width="100px" alt="">
                    <div class="card-header">
                        <div class="card-title">Ubah Foto KK</div>
                    </div>
                    <input type="file" name="img_kk" id="img_kk" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection