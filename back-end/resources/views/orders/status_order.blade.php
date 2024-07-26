@extends('layouts.app')

@section('title','Status Order')

@section('content')

<div class="container pt-5">
    <div class="d-flex">
        <div class="description px-5">
            <table>
                <tr>
                    <td class="p-2">No Invoice</td>
                    <td class="p-2">:</td>
                    <td class="p-2">
                        {{$order->invoice}}
                    </td>
                </tr>
                <tr>
                    <td class="p-2">Unit</td>
                    <td class="p-2">:</td>
                    <td class="p-2">
                        {{$car->merk}} {{$car->type}}
                    </td>
                </tr>
                <tr>
                    <td class="p-2">Tanggal Sewa</td>
                    <td class="p-2">:</td>
                    <td class="p-2">
                        <?php
                        $newDate = date("d/m/Y", strtotime($order->mulai_sewa));
                        echo $newDate;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">Selesai Sewa</td>
                    <td class="p-2">:</td>
                    <td class="p-2">
                        <?php
                        $newDate2 = date("d/m/Y", strtotime($order->selesai_sewa));
                        echo $newDate2;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">Lama Sewa</td>
                    <td class="p-2">:</td>
                    <td class="p-2">
                        {{$order->lama_sewa}} Hari
                    </td>
                </tr>
                <tr>
                    <td class="p-2">Total Harga</td>
                    <td class="p-2">:</td>
                    <td class="p-2">
                        Rp {{number_format($order->total_harga, 0, ',','.')}},00
                    </td>
                </tr>

                @if($order->status=='Dibayar')
                <tr>
                    <td class="p-2">Bayar</td>
                    <td class="p-2">:</td>
                    <td class="p-2">
                        Rp {{number_format($order->total_harga, 0, ',','.')}},00
                    </td>
                </tr>
                @endif
            </table>
        </div>
        <div class="description">
            <table>
                <tr>
                    <td class="p-2">No KTP</td>
                    <td class="p-2">:</td>
                    <td class="p-2">{{$customer->ktp}}</td>
                </tr>
                <tr>
                    <td class="p-2">Nama Pelanggan</td>
                    <td class="p-2">:</td>
                    <td class="p-2">{{$customer->nama}}</td>
                </tr>
                <tr>
                    <td class="p-2">No Whatsapp</td>
                    <td class="p-2">:</td>
                    <td class="p-2">{{$customer->telp}}</td>
                </tr>
                <tr>
                    <td class="p-2">Alamat</td>
                    <td class="p-2">:</td>
                    <td class="p-2" style="width: 300px;">{{$customer->alamat}}</td>
                </tr>
                <tr>
                    <td class="p-2">Tujuan</td>
                    <td class="p-2">:</td>
                    <td class="p-2">{{$order->tujuan}}</td>
                </tr>
                <tr>
                    <td class="p-2">Catatan Pelanggan</td>
                    <td class="p-2">:</td>
                    <td class="p-2">{{$order->catatan}}</td>
                </tr>
                <tr>
                    <td class="p-2">Status Order</td>
                    <td class="p-2">:</td>
                    <td class="p-2">
                        @if($order->status=='Dibayar')
                        <span class="badge rounded-pill text-bg-primary">{{$order->status}}</span>
                        @elseif($order->status=='Belum Dibayar')
                        <span class="badge rounded-pill text-bg-warning">{{$order->status}}</span>
                        @endif
                    </td>
                </tr>

                @if($order->status=='Belum Dibayar')
                <tr>
                    <td class="p-2" colspan="3">
                        <a href="{{url("confirm_order/$order->invoice")}}" class="btn btn-dark">Bayar Order</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="p-2 fs-4">
                        <h5 class="fs-6 text-danger">* Untuk proses lebih lanjut harap lakukan pembayaran minimal 50% dari Total Harga</h5>
                    </td>
                </tr>
                @endif
            </table>
        </div>
    </div>
    @if($order->status=='Dibayar')
    <a href="{{url("status_order/cetak/$order->id")}}" class="btn btn-danger">Unduh</a>
    @endif
</div>

@endsection