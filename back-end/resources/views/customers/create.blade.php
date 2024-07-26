@extends('layouts.app')
@section('title','Tambah Pelanggan')
@section('content')
<div class="container">
    <form action="{{url('customers')}}" method="POST" enctype="multipart/form-data">
        <div class="row pt-5">
            <div class="col-md-6">
                @csrf
                <div class="form-group mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" name="nik" id="nik" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="nama" class="form-label">Nama Pelanggan</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="telp" class="form-label">No Telepon</label>
                    <input type="text" name="telp" id="telp" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success mb-3 mt-3">
                    <div class="card-header">
                        <div class="card-title">Upload Foto KTP</div>
                    </div>
                    <input type="file" name="img_ktp" id="img_ktp" class="form-control" required>
                </div>
                <div class="card card-success mb-3">
                    <div class="card-header">
                        <div class="card-title">Upload Foto SIM</div>
                    </div>
                    <input type="file" name="img_sim" id="img_sim" class="form-control" required>
                </div>
                <div class="card card-success mb-3">
                    <div class="card-header">
                        <div class="card-title">Upload Foto KK</div>
                    </div>
                    <input type="file" name="img_kk" id="img_kk" class="form-control" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection