<html>

<head>
    <title>Cetak</title>
    <style>
        .container {
            width: 100%;
            display: flex;
            justify-content: center;
            text-align: center;
            padding-left: 2rem;
        }
        .container h5 {
            line-height: 0;
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
        .table-head {
            width: 100%;
            border: none;
            margin-top: -25px;
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
            line-height: 0;
        }

        .rental-info {
            text-align: right;
        }

        td.rental-info {
            padding-top: -200px;
        }
        td.rental-info h5 {
            line-height: 0px;
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
                <p style="text-align: center; padding-left:30px;"><span class="title" style="text-align: center; font-size:2rem;">Data Mobil</span>
                </p>
            </td>
        </tr>
    </table>
    <div class="container">
        <h5 style="text-align: right; padding-right:50px;">Jakarta : <?php echo (new \DateTime())->format('d/m/Y'); ?></h5>
        <table class="w-100">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Merk</th>
                    <th>Type</th>
                    <th>Tahun</th>
                    <th>Penumpang</th>
                    <th>Transmisi</th>
                    <th>Bbm</th>
                    <th>Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php($number=1)
                @foreach($cars as $car)
                <tr>
                    <td>{{$number}}</td>
                    <td>
                        <img src="{{public_path("images/cars/$car->image")}}" alt="naninu_picture" width="70px">
                    </td>
                    <td>{{$car->merk}}</td>
                    <td>{{$car->type}}</td>
                    <td>{{$car->tahun}}</td>
                    <td>{{$car->jml_penumpang}}</td>
                    <td>{{$car->transmisi}}</td>
                    <td>{{$car->bbm}}</td>
                    <td>{{$car->harga}}</td>
                    <td>

                        @if($car->isActive==true)
                        Tersedia
                        @else
                        Tidak Tersedia
                        @endif

                    </td>
                </tr>
                @php($number++)
                @endforeach
            </tbody>
        </table>
    </div>


</body>

</html>