<?php


namespace App\Http\Controllers;

require base_path('/vendor/autoload.php');

use Illuminate\Http\Request;
use App\Mail\Ordered;
use App\Models\Car;
use App\Models\Confirm_order;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use PDF;


class OrderController extends Controller
{
    //
    public function create($id)
    {
        $car = Car::where('id', $id)->first();
        $view_data = [
            'car' => $car
        ];

        return view('orders.order', $view_data);
    }

    public function store(Request $request, $id)
    {
        
        
        $request->validate([
            'ktp' => 'required|min:16|max:16',
            'nama_pelanggan' => 'required|min:3|max:100',
            'layanan' => 'required',
            'tujuan' => 'required',
            'tgl_sewa' => 'required',
            'selesai_sewa' => 'required',
            'lama_sewa' => 'required',
            'total_harga' => 'required'
    
        ]);
        $car = Car::where('id', $id)->first();

        
        
        date_default_timezone_set('Asia/Jakarta');
        $invoice = date('Ymdhis', time());
        $nama_pelanggan = $request->input('nama_pelanggan');
        $ktp = $request->input('ktp');
        $catatan = $request->input('catatan');
        if ($catatan == null) {
            $catatan = "-";
        }
        $layanan = $request->input('layanan');
        $tujuan = $request->input('tujuan');
        $tgl_sewa = $request->input('tgl_sewa');
        $selesai_sewa = $request->input('selesai_sewa');
        $lama_sewa = $request->input('lama_sewa');
        $total_harga = $request->input('total_harga');
        // dd($lama_sewa);
        
        if($customer=Customer::where('ktp',$ktp)->first()){
            // dd($customer);
            $customer_id=$customer->id;
            $data = [
                'car_id' => $car->id,
                'customer_id' => $customer_id,
                'invoice' => $invoice,
                'catatan' => $catatan,
                'layanan' => $layanan,
                'tujuan' => $tujuan,
                'mulai_sewa' => $tgl_sewa,
                'selesai_sewa' => $selesai_sewa,
                'lama_sewa' => $lama_sewa,
                'total_harga' => $total_harga,
                'status'=>'Belum Dibayar'
            ];
    
            // dd($data);
    
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;
    
            $params = array(
                'transaction_details' => array(
                    'order_id' => $invoice,
                    'gross_amount' => $total_harga,
                ),
                'customer_details' => array(
                    'nama' => $nama_pelanggan,
                    'no_ktp' => $ktp,
                ),
            );
    
            $snapToken = \Midtrans\Snap::getSnapToken($params);
    
            $data += ["snap_token" => $snapToken];
    
            // dd($data);
    
            $order = Order::create($data);
            
            // dd($order);
            $this->notif_order($order,$car,$customer);
    
    
            return redirect("confirm_order/{$invoice}");
        }else{



            $data = [
                'ktp' => $ktp,
                'nama' => $nama_pelanggan
            ];
            // dd($view_data);
            $view_data=[
                'customer'=>$data,
                'car'=>$car,
            ];
            return view('customers.register', $view_data);
        }
        // dd($tgl_sewa);
        // $mulai_sewa = $request->input('mulai_sewa'->format('d-m-Y'));
        
        // $data = [
        //     'car_id' => $car->id,
        //     'invoice' => $invoice,
        //     'nama_pelanggan' => $nama_pelanggan,
        //     'ktp' => $ktp,
        //     'catatan' => $catatan,
        //     'layanan' => $layanan,
        //     'tujuan' => $tujuan,
        //     'mulai_sewa' => $tgl_sewa,
        //     'selesai_sewa' => $selesai_sewa,
        //     'lama_sewa' => $lama_sewa,
        //     'total_harga' => $total_harga
        // ];

        // dd($data);

        // // Set your Merchant Server Key
        // \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        // \Midtrans\Config::$isProduction = false;
        // // Set sanitization on (default)
        // \Midtrans\Config::$isSanitized = true;
        // // Set 3DS transaction for credit card to true
        // \Midtrans\Config::$is3ds = true;

        // $params = array(
        //     'transaction_details' => array(
        //         'order_id' => $invoice,
        //         'gross_amount' => $total_harga,
        //     ),
        //     'customer_details' => array(
        //         'nama' => $nama_pelanggan,
        //         'no_ktp' => $ktp,
        //     ),
        // );

        // $snapToken = \Midtrans\Snap::getSnapToken($params);

        // $data += ["snap_token" => $snapToken];

        // // dd($data);

        // $order = Order::create($data);
        // // dd($order);
        // $this->notif_order($order, $car);


        // return redirect("confirm_order/{$invoice}");
        // 
    }
    

    public function confirm_order($id)
    {
        $order = Order::where('invoice', $id)->first();

        $car_id = $order->car_id;
        $customer_id = $order->customer_id;
        $car = Car::where('id', $car_id)->first();
        $customer = Customer::where('id', $customer_id)->first();

        $view_data = [
            'order' => $order,
            'car' => $car,
            'customer'=>$customer,
        ];
        return view('orders.confirm_order', $view_data);
    }

    public function store_confirm_order($id)
    {
        // $order = Order::where('id', $id)->first();
        // $order_id = $order->id;

        // $bayar = $request->input('bayar');
        // $keterangan = $request->input('keterangan');

        // if ($request->hasFile('bukti_bayar')) {
        //     $request->file('bukti_bayar')->move('images/confirm_order/', $order->invoice . ".jpg");
        //     $bukti_bayar = $order->invoice . ".jpg";
        // }



        // Confirm_order::create([
        //     'order_id' => $order_id,
        //     'bayar' => $bayar,
        //     'bukti_bayar' => $bukti_bayar,
        //     'keterangan' => $keterangan,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);

        Order::where('id', $id)
            ->update([
                'status' => 'Dibayar'
            ]);

        // dd($order);
        return redirect("status_order/$id");
    }

    public function status_order($id)
    {
        $order = Order::where('id', $id)->first();
        // dd($order);
        $car_id = $order->car_id;
        $customer_id = $order->customer_id;
        $car = Car::where('id', $car_id)->first();
        $customer = Customer::where('id', $customer_id)->first();
        // if ($order->status == "Dibayar") {
        //     $confirm = Confirm_order::where('order_id', $id)->first();

        //     $view_data = [
        //         'order' => $order,
        //         'confirm' => $confirm,
        //         'car' => $car
        //     ];
        // } else {
        $view_data = [
            'order' => $order,
            'car' => $car,
            'customer'=>$customer
        ];
        // }
        return view('orders.status_order', $view_data);
    }

    public function manage_orders()
    {
        // if (!Auth::check()) {
        //     return redirect('login');
        // }
        $orders = Customer::rightJoin('orders', 'orders.customer_id', '=', 'customers.id')
            ->join('cars', 'cars.id', '=', 'orders.car_id')
            ->select('customers.*', 'orders.*', 'cars.merk', 'cars.type', 'cars.harga')
            ->paginate(20);

        $view_data = [
            'orders' => $orders
        ];

        return view('orders.manage', $view_data);
    }

    public function edit($id)
    {
        // if (!Auth::check()) {
        //     return redirect('login');
        // }
        $order = Customer::rightJoin('orders', 'orders.customer_id', '=', 'customers.id')
            ->join('cars', 'cars.id', '=', 'orders.car_id')
            ->select('customers.*', 'orders.*', 'cars.merk', 'cars.type', 'cars.harga')
            ->where('orders.id', '=', $id)->first();

        // dd($order);
        $view_data = [
            'order' => $order
        ];

        return view('orders.edit', $view_data);
    }

    public function update(Request $request)
    {

        $nopol = $request->input('nopol');
        $invoice = $request->input('invoice');
        $catatan = $request->input('catatan');
        $layanan = $request->input('layanan');
        $tujuan = $request->input('tujuan');
        $tgl_sewa = $request->input('tgl_sewa');
        $selesai_sewa = $request->input('selesai_sewa');
        $lama_sewa = $request->input('lama_sewa');
        $total_harga = $request->input('total_harga');
        $overtime = $request->input('overtime');
        $order = Order::where('invoice', $invoice)->first();

        $id_order = $order->id;

        
            Order::where('orders.id', '=', $id_order)->update([
                'nopol' => $nopol,
                'catatan' => $catatan,
                'layanan' => $layanan,
                'tujuan' => $tujuan,
                'mulai_sewa' => $tgl_sewa,
                'selesai_sewa' => $selesai_sewa,
                'lama_sewa' => $lama_sewa,
                'total_harga' => $total_harga,
                'overtime' => $overtime,
            ]);
        
        return redirect("order/$order->id/edit");
    }
    public function destroy($id)
    {
        //
        Order::where('id', $id)->delete();

        return redirect('manage_orders');
    }

    public function search_order(Request $request)
    {
        $invoice = $request->input('invoice');

        $order = Order::where('invoice', '=', $invoice)->first();

        return redirect("status_order/$order->id");
    }

    public function orders_search(Request $request)
    {
        $keyword = $request->input('keyword');
        if ($keyword) {
            $orders = Customer::rightJoin('orders', 'orders.customer_id', '=', 'customers.id')
                ->join('cars', 'cars.id', '=', 'orders.car_id')
                ->select('customers.*', 'orders.*', 'cars.merk', 'cars.type', 'cars.harga')
                ->where('merk', 'like', '%' . $keyword . '%')
                ->orWhere('type', 'like', '%' . $keyword . '%')
                ->orWhere('nama', 'like', '%' . $keyword . '%')
                ->orWhere('ktp', 'like', '%' . $keyword . '%')
                ->orWhere('nopol', 'like', '%' . $keyword . '%')
                ->orWhere('telp', 'like', '%' . $keyword . '%')
                ->orWhere('alamat', 'like', '%' . $keyword . '%')
                ->orWhere('tujuan', 'like', '%' . $keyword . '%')
                ->orWhere('mulai_sewa', 'like', '%' . $keyword . '%')
                ->orWhere('lama_sewa', 'like', '%' . $keyword . '%')
                ->orWhere('status', 'like', '%' . $keyword . '%')
                ->paginate(20);
            $view_data = [
                'orders' => $orders,
            ];
            return view('orders.manage', $view_data);
        } else {
            return redirect("manage_orders");
        }
    }
    public function cetak_transaksi(Request $request)
    {
        $tanggal1 = $request->input('dari_tanggal');
        $tanggal2 = $request->input('sampai_tanggal');

        $orders = Customer::rightJoin('orders', 'orders.customer_id', '=', 'customers.id')
            ->join('cars', 'cars.id', '=', 'orders.car_id')
            ->select('customers.*', 'orders.*', 'cars.merk', 'cars.type', 'cars.harga')
            ->whereBetween('orders.mulai_sewa', [$tanggal1, $tanggal2])->get();
        // dd($orders);
        $view_data = [
            'orders' => $orders
        ];
        // dd($view_data);
        $dompdf = PDF::loadView('pdf.orders_pdf', $view_data)->setPaper('a4', 'landscape');
        set_time_limit(300);
        return $dompdf->stream('orders.pdf');
    }

    public function cetak_bukti_bayar($id)
    {
        $order = Customer::rightJoin('orders', 'orders.customer_id', '=', 'customers.id')
            ->join('cars', 'cars.id', '=', 'orders.car_id')
            ->select('customers.*', 'orders.*', 'cars.merk', 'cars.type', 'cars.harga')
            ->where('orders.status','=','Dibayar')->first();
        
            $view_data = [
                'order' => $order,
            ];
        


        $dompdf = PDF::loadView('pdf.status_order_pdf', $view_data);
        set_time_limit(300);
        return $dompdf->download('bukti_bayar.pdf');
    }
    public function cetak_kwitansi($id)
    {
        $order = Customer::rightJoin('orders', 'orders.customer_id', '=', 'customers.id')
            ->join('cars', 'cars.id', '=', 'orders.car_id')
            ->select('customers.*', 'orders.*', 'cars.merk', 'cars.type', 'cars.harga')
            ->where('orders.status','=','Dibayar')->first();
        
            $view_data = [
                'order' => $order,
            ];

        $dompdf = PDF::loadView('pdf.kwitansi_pdf', $view_data)->setPaper(array(0, 0, 659.4488, 450.225), 'letter');
        set_time_limit(300);
        return $dompdf->stream('kwitansi.pdf');
    }

    public function cetak_checklist($id)
    {
        $order = Customer::rightJoin('orders', 'orders.customer_id', '=', 'customers.id')
            ->join('cars', 'cars.id', '=', 'orders.car_id')
            ->select('customers.*', 'orders.*', 'cars.merk', 'cars.type', 'cars.harga')
            ->where('orders.status','=','Dibayar')->first();
        
            $view_data = [
                'order' => $order,
            ];




        $dompdf = PDF::loadView('pdf.checklist_pdf', $view_data)->setPaper('a4', 'potrait');
        set_time_limit(300);
        return $dompdf->stream('checklist.pdf');
    }

    private function notif_order($order, $car,$customer)
    {
        $api_token = "7115116963:AAFik8kXQidQvIsQI6AEodiMZIzuFJNosdA";
        $url = "https://api.telegram.org/bot{$api_token}/sendMessage";
        $chat_id = -4150850750;
        $content = "<strong>Order Sewa Mobil</strong>
                    \n<strong><em> Invoice : $order->invoice</em></strong>
                    \nUnit         : $car->merk $car->type
                    \nTahun        : $car->tahun
                    \nTransmisi    : $car->transmisi
                    \nHarga        : $car->harga
                    \nLayanan Sewa : $order->layanan
                    \nTanggal Sewa : $order->mulai_sewa
                    \nLama Sewa    : $order->lama_sewa
                    \nTujuan       : $order->tujuan
                    \nTotal Harga  : $order->total_harga
                    \n \n
                    \n<strong>Pelanggan</strong>
                    \nNo KTP        : $customer->ktp
                    \nNama Penyewa  : $customer->nama
                    \nNo Whatsapp   : $customer->telp
                    \nAlamat        : $customer->alamat
                    \nCatatan       : $order->catatan
                    ";
        $data = [
            'chat_id' => $chat_id,
            'text' => $content,
            'parse_mode' => "HTML"
        ];
        Http::post($url, $data);
        set_time_limit(300);
    }
}
