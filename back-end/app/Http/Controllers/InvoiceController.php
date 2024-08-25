<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Customer::rightJoin('orders','orders.customer_id','=','customers.id')
        ->join('cars','cars.id','=','orders.car_id')
        ->join('invoices','invoices.no_invoice','=','orders.invoice')
        ->select('customers.*','orders.*','invoices.*','cars.merk','cars.type','cars.harga')->where('invoices.active',1)->get();
    
        $view_data = [
            'orders'=>$orders
        ];

        // dd($view_data);
    

        return view('invoice.index',$view_data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $order = Customer::rightJoin('orders','orders.customer_id','=','customers.id')
        ->join('cars','cars.id','=','orders.car_id')
        ->select('customers.*','orders.*','cars.merk','cars.type','cars.harga')
        ->where('orders.id','=',$id)->first();

        
        if(Invoice::where('no_invoice','=',$order->invoice)->first()){
            return redirect('invoices');
        }else{
            $view_data=[
                'order'=>$order,
            ];
            return view('invoice.create', $view_data);
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $invoice = $request->input('invoice');

        $order = Order::where('invoice','=',$invoice)->first();

        $tanggal = $request->input('tanggal');
        $user = $request->input('user');
        $driver = $request->input('driver');
        $uang_makan = $request->input('uang_makan');
        $penginapan = $request->input('penginapan');
        $bbm = $request->input('bbm');
        $tol = $request->input('tol');
        $parkir = $request->input('parkir');
        $steam = $request->input('steam');
        $nitrogen = $request->input('nitrogen');
        $total = $request->input('total_invoice');

        if($user == null){
            $user = "-";
        }
        if($driver == null){
            $driver = "-";
        }
        if($uang_makan == null){
            $uang_makan = 0;
        }
        if($penginapan == null){
            $penginapan = 0;
        }
        if($bbm == null){
            $bbm = 0;
        }
        if($tol == null){
            $tol = 0;
        }
        if($parkir == null){
            $parkir = 0;
        }
        if($steam == null){
            $steam = 0;
        }
        if($nitrogen == null){
            $nitrogen = 0;
        }

        $data = [
            'no_invoice'=> $invoice,
            'driver' => $driver,
            'user' => $user,
            'tanggal' => $tanggal,
            'uang_makan' => $uang_makan,
            'penginapan'=>$penginapan,
            'bbm' => $bbm,
            'tol' => $tol,
            'parkir' => $parkir,
            'steam'=>$steam,
            'nitrogen'=>$nitrogen,
            'harga_invoice'=>$total
        ];



        // Nitrogen Error tidak boleh NUll
        Invoice::create($data);

        return redirect("invoices");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $order = Customer::rightJoin('orders','orders.customer_id','=','customers.id')
        ->join('cars','cars.id','=','orders.car_id')
        ->join('invoices','invoices.no_invoice','=','orders.invoice')
        ->select('customers.*','orders.*','invoices.*','cars.merk','cars.type','cars.harga')
        ->where('orders.invoice', '=', $id)->first();
    
        $view_data = [
            'order'=>$order
        ];

        // dd($view_data);
    

        return view('invoice.show',$view_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $invoice = $request->input('invoice');

        $order = Order::where('invoice','=',$invoice)->first();

        $tanggal = $request->input('tanggal');
        $user = $request->input('user');
        $driver = $request->input('driver');
        $uang_makan = $request->input('uang_makan');
        $penginapan = $request->input('penginapan');
        $bbm = $request->input('bbm');
        $tol = $request->input('tol');
        $parkir = $request->input('parkir');
        $steam = $request->input('steam');
        $nitrogen = $request->input('nitrogen');
        $total = $request->input('total_invoice');

        if($user == null){
            $user = "-";
        }
        if($driver == null){
            $driver = "-";
        }
        if($uang_makan == null){
            $uang_makan = 0;
        }
        if($penginapan == null){
            $penginapan = 0;
        }
        if($bbm == null){
            $bbm = 0;
        }
        if($tol == null){
            $tol = 0;
        }
        if($parkir == null){
            $parkir = 0;
        }
        if($steam == null){
            $steam = 0;
        }
        if($nitrogen == null){
            $nitrogen = 0;
        }

        Invoice::where('no_invoice','=',$id)->update([
            'no_invoice'=> $invoice,
            'driver' => $driver,
            'user' => $user,
            'tanggal' => $tanggal,
            'uang_makan' => $uang_makan,
            'penginapan'=>$penginapan,
            'bbm' => $bbm,
            'tol' => $tol,
            'parkir' => $parkir,
            'steam'=>$steam,
            'nitrogen'=>$nitrogen,
            'harga_invoice'=>$total
        ]);

        return redirect("invoices");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Invoice::where('no_invoice',$id)->update(['active'=>0]);
        Invoice::where('no_invoice',$id)->delete();

        return redirect('invoices');
    }

    public function cetak(Request $request,$id){
        $order = Customer::rightJoin('orders','orders.customer_id','=','customers.id')
        ->join('cars','cars.id','=','orders.car_id')
        ->join('invoices','invoices.no_invoice','=','orders.invoice')
        ->select('customers.*','orders.*','invoices.*','cars.merk','cars.type','cars.harga')
        ->where('orders.invoice', '=', $id)->first();
    
        $view_data = [
            'order'=>$order
        ];
        if($order->layanan == 'Mobil Saja'){
        
            $dompdf = PDF::loadView('pdf.invoice_pdf', $view_data)->setPaper('a4','potrait');
            set_time_limit(300);
            return $dompdf->stream('orders.pdf');

        }
        
    }
}
