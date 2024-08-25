<?php

namespace App\Http\Controllers;

use App\Models\Services;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $services = Services::get();

        $view_data = [
            'services' => $services
        ];

        return view('services.index',$view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('services.create');
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
        $layanan = $request->layanan;
        $harga = $request->harga;



        Services::create([
            'layanan' => $layanan,
            'harga'=>$harga
        ]);

        return redirect('services');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function edit(Services $services,$id)
    {
        // \
        $service = Services::where('id',$id)->first();

        // dd($service);
        return view('services.edit', ['service'=>$service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $service = Services::where('id',$id)->first();

        Services::where('id',$id)->update([
            'layanan' => $request->input('layanan'),
            'harga' => $request->input('harga'),
        ]);


        return redirect("service/$service->id/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function destroy(Services $services, $id)
    {
        //
        Services::where('id',$id)->delete();


        return redirect("/services");
    }
}
