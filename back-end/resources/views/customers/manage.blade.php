@extends('layouts.app')
@section('title','Kelola Data Pelanggan')
@section('content')

<div class="container">
    <h1>Kelola Data Pelanggan</h1>
    <div class="row">
        <div class="col-12">
            <!-- @if(Auth::check()) -->
            <!-- @endif -->
            <a href="{{url("customer/create")}}" class="btn btn-dark">Tambah Pelanggan</a>
            <a href="{{url("cars/cetak_data_mobil")}}" class="btn btn-danger">Cetak PDF</a>
        </div>
    </div>
    <table class="w-100 table">
        <thead>
            <tr class="table-success">
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>No Telpon</th>
                <th>E-Mail</th>
                <th>Alamat</th>
                <th>Foto KTP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php($number=1)
            @foreach($customers as $customer)
            <tr>
                <td>{{$number}}</td>
                <td>
                    <a href="{{url("customer/$customer->id")}}" class="text-success">{{$customer->ktp}}</a>
                </td>
                <td>{{$customer->nama}}</td>
                <td>{{$customer->telp}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->alamat}}</td>
                <td><img src="{{asset("images/pelanggan/img_ktp/$customer->img_ktp")}}" alt="foto ktp" width="70px"></td>
                <td class="d-flex">
                    <a href="{{url("customer/$customer->id/edit")}}" class="text-decoration-none">
                        <button class="badge text-bg-primary">
                            Ubah
                        </button>
                    </a>
                    <form action="{{url("customer/$customer->id")}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="badge text-bg-primary" onclick="return confirm('Yakin ingin hapus ?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @php($number++)
            @endforeach


        </tbody>
    </table>
    {{$customers->withQueryString()->links('pagination::bootstrap-5')}}
</div>

@endsection