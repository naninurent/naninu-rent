@extends('layouts.app')

@section('title','Kelola Data Invoice')
@section('content')

<div class="container-fluid px-3">
    <h1>Kelola Data Invoice</h1>
    <div class="row">
        <div class="col-md-3">
            <form class="col-12 me-3 col-lg-auto mb-3 mb-lg-0 d-flex px-5 p-lg-0" role="search" action="{{url("orders/search")}}" method="GET">
                <input type="search" class="form-control" name="keyword" placeholder="Cari Order..." aria-label="Search">
                <button type="submit" class="btn btn-success">Cari</button>
            </form>
        </div>
    </div>
    <table class="w-100">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Driver</th>
                <th>User</th>
                <th>No Polisi</th>
                <th>Unit</th>
                <th>Layanan</th>
                <th>Tujuan</th>
                <th>Mulai Sewa</th>
                <th>Selesai Sewa</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php($number=1)
            @foreach($orders as $order)
            <tr>
                <td>{{$number}}</td>
                <td>
                <a href="{{url("invoice/$order->invoice")}}" class="text-success">
                    {{$order->invoice}}
                </a>
            </td>
                <td>{{$order->tanggal}}</td>
                <td>{{$order->nama}}</td>
                <td>{{$order->driver}}</td>
                <td>{{$order->user}}</td>
                <td>{{$order->nopol}}</td>
                <td>{{$order->type}}</td>
                <td>{{$order->layanan}}</td>
                <td>{{$order->tujuan}}</td>
                <td>{{$order->mulai_sewa}}</td>
                <td>{{$order->selesai_sewa}}</td>
                <td>{{$order->total_harga}}</td>
                
                <td class="d-flex">
                    <a href="{{url("print_invoice/$order->invoice")}}" class="text-decoration-none">
                        <button class="badge text-bg-success">
                            Cetak
                        </button>
                    </a>
                    <form action="{{url("order/$order->id")}}" method="POST">
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
</div>

@endsection