<html>

<head>
    <title>Cetak Orders</title>
    <style>
        .container {
            width: 100%;
            display: flex;
            justify-content: center;
            text-align: center;
            padding-left: 2rem;
        }

        table {
            text-align: center;
            border: 1px solid black;
        }

        thead,
        td,
        th {
            border-bottom: 1px solid black;
            border-left: 1px solid black;
        }
        <style>
        .container {
            border-bottom: 1px dashed black;
        }

        .table-head {
            width: 100%;
            border: none;
            margin-top: -25px;
        }

        .table-child {
            margin-top: -20px;
        }

        .table-head-3 {
            margin-top: -15px;
            margin-bottom: -10px;
        }
        .table-head td, .table-head tr{
            border: none;
        }
        .table-head p, .table-head h5 {
            font-size: 1rem;
        }

        .table-child {
            width: 100%;
            padding-top: 20px;
        }

        td {
            padding: 0;
            text-align: left;
        }

        .rental-info {
            text-align: right;
            margin-bottom: 20px;
        }

        td.rental-info {
            padding-top: -200px;
        }

        td.rental-info h5 {
            line-height: 0px;
        }

        .title {
            padding-right: 0px;
            font-weight: bold;
        }

        span.time {
            text-align: right;
            padding-left: 120px;
        }

        .judul-table p {
            font-size: 14px;
            padding-top: 6px;
        }

        .judul-table {
            border-bottom: 1px solid black;
            border-top: 1px solid black;
        }

        p {
            line-height: 1px;
            font-size: 0.7rem;
        }
        .container table td:first-child{
            border-left: none;
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
            <td colspan="4" class="rental-info judul-table">
                <p style="text-align: center; padding-left:30px;"><span class="title" style="text-align: center; font-size:2rem;">Data Transaksi Sewa Mobil</span>
                </p>
            </td>
        </tr>
    </table>
    <div class="container-fluid px-3">
        <table class="w-100">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Invoice</th>
                    <th>No Polisi</th>
                    <th>Unit</th>
                    <th>Nama</th>
                    <th>KTP</th>
                    <th>Telp</th>
                    <th>Layanan</th>
                    <th>Tujuan</th>
                    <th>Mulai Sewa</th>
                    <th>Lama Sewa</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php($number=1)
                @foreach($orders as $order)
                <tr>
                    <td>{{$number}}</td>
                    <td>{{$order->invoice}}</td>
                    <td>{{$order->nopol}}</td>
                    <td>{{$order->merk}} {{$order->type}}</td>
                    <td>{{$order->nama_pelanggan}}</td>
                    <td>{{$order->ktp}}</td>
                    <td>{{$order->telp}}</td>
                    <td>{{$order->layanan}}</td>
                    <td>{{$order->tujuan}}</td>
                    <td>{{$order->mulai_sewa}}</td>
                    <td class="text-center">{{$order->lama_sewa}}</td>
                    <td>{{$order->total_harga}}</td>
                    <td>{{$order->status}}</td>
                </tr>
                @php($number++)
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>