@extends('layouts.app')
@section('title','Layanan Sewa')

@section('content')

    <div class="container pt-3">
        <a class="btn btn-primary" href="services/create">Tambah</a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Layanan</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @php($number=1)
                @foreach($services as $service)
                <tr>
                    <td>{{$number}}</td>
                    <td><a href="{{url("service/$service->id/edit")}}" > {{$service->layanan}} </a></td>
                    <td>{{$service->harga}}</td>
                </tr>
                @php($number++)
                @endforeach
            </tbody>
        </table>
    </div>
@endsection