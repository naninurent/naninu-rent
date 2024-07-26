@extends('layouts.app')

@section('title',"Profil | $customer->nama")
@section('content')

    <div class="container ">
        <div class="row">
            <div class="col-md-4 border-end border-dark-subtle ps-3 pe-3 mt-1">
                <table class="table identitas-pelanggan">
                    <tr>
                        <td colspan="3">
                            <h2 class="h2 text-success fs-4 pt-xl-4 pt-3">{{$customer->nama}}</h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            NIK
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            {{$customer->ktp}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            No Telepon
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            {{$customer->telp}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            E-Mail
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            {{$customer->email}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Alamat
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            {{$customer->alamat}}
                        </td>
                    </tr>
                </table>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{url("customer/$customer->id/edit")}}" class="btn btn-success">Ubah Data Pelanggan</a><a href="" class="btn btn-danger">Hapus Pelanggan</a>
                </div>
            </div>
            <div class="col-md-8 mt-md-2 mt-2 d-flex justify-content-center align-items-center flex-wrap identitas flex-direction-column">
                <div class="heading">
                    <h4 class="h4">Identitas Pelanggan</h4>
                </div>
                <div class="ktp-sim w-100 d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <img src="{{asset("images/pelanggan/img_ktp/$customer->img_ktp")}}" class="img-fluid rounded" width="49%; me-2" alt="Foto KTP">
                    <img src="{{asset("images/pelanggan/img_sim/$customer->img_sim")}}" class="img-fluid rounded" width="49%;" alt="Foto SIM">
                </div>   
                <img src="{{asset("images/pelanggan/img_kk/$customer->img_kk")}}" class="img-fluid rounded" width="100%;" alt="Foto KK">
            </div>
        </div>
    </div>

@endsection