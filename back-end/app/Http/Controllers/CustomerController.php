<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = Customer::where('active',1)->paginate(20);

        $view_data = [
            'customers'=> $customers
        ];
        return view('customers.manage', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('customers.create');
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
        $nik = $request->input('nik');
        $nama = $request->input('nama');
        $telp = $request->input('telp');
        $email = $request->input('email');
        $alamat = $request->input('alamat');


        $request->validate([
            'img_ktp' => 'image|mimes:png,jpg,jpeg,svg',
            'img_sim' => 'image|mimes:png,jpg,jpeg,svg',
            'img_kk' => 'image|mimes:png,jpg,jpeg,svg',
        ]);
        //image
        if($request->hasFile('img_ktp')){
            $img_ktp = $nik . "-ktp-". $nama . $request->img_ktp->extension();
            $request->file('img_ktp')->move(public_path('images/pelanggan/img_ktp/'),$img_ktp);
        }
        if($request->hasFile('img_sim')){
            $img_sim = $nik . "-sim-". $nama . $request->img_sim->extension();
            $request->file('img_sim')->move(public_path('images/pelanggan/img_sim/'),$img_sim);
        }
        if($request->hasFile('img_kk')){
            $img_kk = $nik . "-kk-". $nama . $request->img_kk->extension();
            $request->file('img_kk')->move(public_path('images/pelanggan/img_kk/'), $img_kk);
        }

        Customer::create([
            'ktp' => $nik,
            'nama' => $nama,
            'telp' => $telp,
            'email' => $email,
            'alamat' => $alamat,
            'img_ktp' => $img_ktp,
            'img_sim' => $img_sim,
            'img_kk' => $img_kk
        ]);

        return redirect('manage_customers');
    }

    public function register(Request $request)
    {
        //
        $nik = $request->input('nik');
        $nama = $request->input('nama');
        $telp = $request->input('telp');
        $email = $request->input('email');
        $alamat = $request->input('alamat');
        $car_id = $request->input('car_id');

        $request->validate([
            'img_ktp' => 'image|mimes:png,jpg,jpeg,svg',
            'img_sim' => 'image|mimes:png,jpg,jpeg,svg',
            'img_kk' => 'image|mimes:png,jpg,jpeg,svg',
        ]);
        //image
        if($request->hasFile('img_ktp')){
            $img_ktp = $nik . "-ktp-". $nama . $request->img_ktp->extension();
            $request->file('img_ktp')->move(public_path('images/pelanggan/img_ktp/'),$img_ktp);
        }
        if($request->hasFile('img_sim')){
            $img_sim = $nik . "-sim-". $nama . $request->img_sim->extension();
            $request->file('img_sim')->move(public_path('images/pelanggan/img_sim/'),$img_sim);
        }
        if($request->hasFile('img_kk')){
            $img_kk = $nik . "-kk-". $nama . $request->img_kk->extension();
            $request->file('img_kk')->move(public_path('images/pelanggan/img_kk/'), $img_kk);
        }

        Customer::create([
            'ktp' => $nik,
            'nama' => $nama,
            'telp' => $telp,
            'email' => $email,
            'alamat' => $alamat,
            'img_ktp' => $img_ktp,
            'img_sim' => $img_sim,
            'img_kk' => $img_kk
        ]);

        return redirect("order/$car_id");
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
        $customer = Customer::where('id',$id)->first();
        $view_data = [
            'customer'=>$customer
        ];

        return view('customers.show', $view_data);
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
        $customer = Customer::where('id',$id)->first();
        $view_data = [
            'customer'=>$customer
        ];

        return view('customers.edit', $view_data);
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
        //imglama
        $customer = Customer::where('id',$id)->first();

        //
        $nik = $request->input('nik');
        $nama = $request->input('nama');
        $telp = $request->input('telp');
        $email = $request->input('email');
        $alamat = $request->input('alamat');

        $request->validate([
            'img_ktp'=>'image|mimes:png,jpg,jpeg,svg',
            'img_sim'=>'image|mimes:png,jpg,jpeg,svg',
            'img_kk'=>'image|mimes:png,jpg,jpeg,svg',
            ]);
        //image
        if($request->hasFile('img_ktp')){
            File::delete('images/pelanggan/img_ktp/',$customer->img_ktp);
            $img_ktp = $nik . "-ktp-". $nama . $request->img_ktp->extension();
            $request->file('img_ktp')->move(public_path('images/pelanggan/img_ktp/'),$img_ktp);
            Customer::where('id',$id)->update([
                'img_ktp' => $img_ktp,
            ]);
        }
        if($request->hasFile('img_sim')){
            File::delete('images/pelanggan/img_sim/',$customer->img_sim);
            $img_sim = $nik . "-sim-". $nama . $request->img_sim->extension();
            $request->file('img_sim')->move(public_path('images/pelanggan/img_sim/'),$img_sim);
            Customer::where('id',$id)->update([
                'img_sim' => $img_sim,
            ]);
        }
        if($request->hasFile('img_kk')){
            File::delete('images/pelanggan/img_kk/',$customer->img_kk);
            $img_kk = $nik . "-kk-". $nama . $request->img_kk->extension();
            $request->file('img_kk')->move(public_path('images/pelanggan/img_kk/'),$img_kk);
            Customer::where('id',$id)->update([
                'img_kk' => $img_kk,
            ]);
        }

        Customer::where('id',$id)->update([
            'ktp' => $nik,
            'nama' => $nama,
            'telp' => $telp,
            'email' => $email,
            'alamat' => $alamat,
        ]);

        return redirect("customer/$id");
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
        Customer::where('id',$id)->update(['active'=>0]);
        Customer::where('id',$id)->delete();

        return redirect('manage_customers');
    }
}
