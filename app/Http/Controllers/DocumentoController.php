<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function total($ruc, $type)
    {
        $factura = Invoice::join('enterprises', 'invoices.enterprise_id' , '=' ,'enterprises.id')
        ->where('number_doc',$ruc)
        ->where('type_doc',$type)
        ->count();
        return $factura;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function doc($fecha_emision, $ruc, $type, $series, $number, $total){


        $doc = Invoice::whereDate('date_of_issue',$fecha_emision)
        ->join('enterprises', 'invoices.enterprise_id' , '=' ,'enterprises.id')
        ->select('invoices.status')
        ->where('number_doc',$ruc)
        ->where('type_doc',$type)
        ->where('invoices.series',$series)
        ->where('number',$number)
        ->where('total',$total)
        ->get();
        return $doc;
    }
    public function store(Request $request)
    {
        //
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
    }
}
