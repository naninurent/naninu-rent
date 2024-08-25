<?php
use Carbon\Carbon;

date_default_timezone_set('Asia/Jakarta');
$date = date('d/m/Y', time());
$dateName = Carbon::now()->locale('id')->isoFormat('LL');

?>
<html>

<head>
    <title>Cetak Status Order</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        .container {
            border-bottom: 1px dashed black;
        }

        .table-head {
            width: 100%;
            margin-top: -25px;
        }
        .table-head .rental-info{
            text-align: right;
            margin-bottom: 100px;
        }
        .table-head .rental-info p{
            font-size: 0.8rem;
            line-height: 0.3;
        }
        .table-head .rental-info h5{
            font-size: 1.2rem;
            line-height: 0.4;
        }
        .info_invoice th{
            font-size: 0.9rem;
        }
        .info_invoice td{
            font-size: 0.9rem;
            line-height: 1;
        }
        table{
            border-collapse: collapse;
        }
        .table-body{
            width: 100%;
        }
        .table-body th{
            background-color: #316b69;
            border: 2px solid black;
            font-size: 0.9rem;
        }
        .table-body td{
            border: 2px solid black;
            font-size: 0.9rem;

        }

        .informasi p{
            font-size:0.8rem;
        }
        .informasi p:last-child(){
            font-weight: bold;
        }

        .table-body td{
            text-align:center;
        }
        .table-body td:nth-child(2){
            text-align: left;
        }
        .table-body td:nth-child(7), .table-body td:last-child{
            text-align: right;
        }
    </style>
</head>

<body>
    <table class="table-head">
        <tr>
            <td>
                <img src="{{public_path("images/logo.png")}}" alt="" width="200px" height="90px">
            </td>
            <td colspan="3">
                <div class="rental-info">
                    <h5>NANINU RENT</h5>
                    <!-- <small>Jakarta</small> -->
                    <p>Jln. Mampang Prapatan V No.70 Rt009/Rw006, Jakarta Selatan, 12790</p>
                    <p>Phone : 021-79182997, 0858-8275-9455, 0899-5395-345</p>
                    <p>E-Mail : naninurent@gmail.com</p>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" rowspan="3" style="padding-top: 3rem;">
                Ditujukan kepada : <br>
                Yth. {{$order->nama}}
            </td>
            <td colspan="2" style="float: right; text-align:right; padding-top:1.7rem;">
                <div class="info_invoice">
                    <table style="float: right; margin-top:-10px;">
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align: center; font-weight:bold; background-color:gray;">INVOICE</th>
                            </tr>
                        </thead>
                        <tr>
                            <td style="padding-top: 5px;">No</td>
                            <td style="padding-top: 5px;">:</td>
                            <td style="padding-top: 5px;">{{$order->invoice}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>{{$date}}</td>
                        </tr>
                        <tr>
                            <td>No Polisi</td>
                            <td>:</td>
                            <td>{{$order->nopol}}</td>
                        </tr>
                        <tr>
                            <td>User</td>
                            <td>:</td>
                            <td>{{$order->user}}</td>
                        </tr>
                        <tr>
                            <td>Tujuan</td>
                            <td>:</td>
                            <td>{{$order->tujuan}}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <table class="table-body" >
        <thead>
            <tr>
                <th>No</th>
                <th>Deskripsi</th>
                <th>Unit</th>
                <th>Start</th>
                <th>Finish</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Sub.Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    1
                </td>
                <td>
                    {{$order->layanan}}
                </td>
                <td>
                    {{$order->type}}
                </td>
                <td>
                    <?php
                    $newDate = date("d M Y", strtotime($order->mulai_sewa));
                    echo $newDate;
                    ?>
                </td>
                <td>
                <?php
                    $newDate2 = date("d M Y", strtotime($order->selesai_sewa));
                    echo $newDate2;
                    ?>
                </td>
                <td>
                    {{$order->lama_sewa}} Hari
                </td>
                <td>
                    Rp. {{number_format($order->harga, 0, ',','.')}}.00
                </td>
                <td>
                    <?php
                    $harga_sewa = (int)$order->harga * (int)$order->lama_sewa;
                    ?>
                    Rp. <span>{{number_format($harga_sewa, 0, ',','.')}}.00</span>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Uang Makan</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    @if($order->uang_makan!=0)
                        Rp. {{ number_format($order->uang_makan, 0, ',' ,'.') . ".00"}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Penginapan</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    @if($order->penginapan==0)
                    
                    @else
                        Rp. {{number_format($order->penginapan, 0, ',','.') . ".00"}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>BBM</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    @if($order->bbm!=0)
                    Rp. {{number_format($order->bbm, 0, ',','.') . ".00"}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>TOL</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    @if($order->tol!=0)
                    Rp. {{number_format($order->tol, 0, ',','.') . ".00"}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>6</td>
                <td>Parkir</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    @if($order->parkir!=0)
                        Rp. {{number_format($order->parkir, 0, ',','.') . ".00"}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>7</td>
                <td>Cuci Steam</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    @if($order->steam!=0)
                    Rp. {{number_format($order->steam, 0, ',','.') . ".00"}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>8</td>
                <td>Overtime</td>
                <td></td>
                <td></td>
                <td></td>

                @if($order->overtime == 0)
                <td>
                    {{" "}}
                </td>
                @else
                <td>
                    {{$order->overtime}} Jam
                </td>
                    @endif
                <td style="text-align: right;">
                    <?php
                        if($order->overtime == 0){
                            $harga_overtime = " ";
                            echo $harga_overtime;
                        }else{
                            $harga_overtime = $order->harga / 10 ;
                            echo "Rp. " . number_format($harga_overtime, 0, ',','.') . ".00";
                        }
                    ?>
                </td>
                <td style="text-align: right;">
                    <?php
                    if($order->overtime == 0){
                        $total_harga_ovt = " ";
                        echo $total_harga_ovt;
                    }else{
                        $total_harga_ovt = $order->overtime * $harga_overtime;
                        echo "Rp. " . number_format($total_harga_ovt, 0, ',','.') . ".00";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>9</td>
                <td>Nitrogen (Tambal Ban)</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    @if($order->nitrogen!=0)
                    Rp. {{number_format($order->nitrogen, 0, ',','.') . ".00"}}
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="7" style="text-align: right; padding-right:10px;">Total</td>
                <td style="text-align:right;">Rp. {{number_format($order->total_harga, 0, ',','.')}}.00</td>
            </tr>
            <tr>
                <td colspan="7" style="text-align: right; padding-right:10px;">DP</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="7" style="text-align: right; padding-right:10px;">Sisa</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <div class="informasi">
        <p>Terbilang : </p>
        <p></p>
        <p>* Pembayaran Harap ditransfer ke Rekening MANDIRI (1290-0131-6777-6) BAMBANG SATMOTO</p>
    </div>
    <div style="padding-right: 20px; float:right;" >
        <p style="text-align: center;">Naninu Rent Car  </p>
        <p></p>
        <p></p>
        <p style="text-align: center;">Bambang Satmoto</p>
    </div>
