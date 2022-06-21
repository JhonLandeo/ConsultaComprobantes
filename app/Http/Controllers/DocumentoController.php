<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\Invoice;
use App\Models\Voided;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
   
    public function index()
    {



        return view('welcome');
    }

   
    public function total($ruc, $type)
    {
        $factura = Invoice::join('enterprises', 'invoices.enterprise_id' , '=' ,'enterprises.id')
        ->where('number_doc',$ruc)
        ->where('type_doc',$type)
        ->count();
        return $factura;
    }

    public function totalGuias($ruc, $type){
        $factura = Guide::join('enterprises', 'guides.enterprise_id' , '=' ,'enterprises.id')
        ->where('number_doc',$ruc)
        ->where('type_doc',$type)
        ->count();
        return $factura;
    }

   
    public function doc( $ruc, $type, $series, $number){


        $doc = Invoice::/* whereDate('date_of_issue',$fecha_emision) */
        join('enterprises', 'invoices.enterprise_id' , '=' ,'enterprises.id')
        ->select('invoices.status')
        ->where('number_doc',$ruc)
        ->where('type_doc',$type)
        ->where('invoices.series',$series)
        ->where('number',$number)
        /* ->where('total',$total) */
        ->get();
        return $doc;
    }

    
    
    public function procesar($created_at){
        $pendientes = Invoice::where('status',0)->whereDate('created_at',$created_at)->count();
        $pendienteF = Invoice::where('status',0)->whereDate('created_at',$created_at)->where('type_doc',01)->count();
        $pendienteB = Invoice::where('status',0)->whereDate('created_at',$created_at)->where('type_doc',03)->count();
        $pendienteNC = Invoice::where('status',0)->whereDate('created_at',$created_at)->where('type_doc',07)->count();
       /*  $pendienteNB = Invoice::where('status',0)->where('type_doc',08)->count(); */
        $rechazados = Invoice::where('status',2)->whereDate('created_at',$created_at)->count();
        $rechazadosF = Invoice::where('status',2)->whereDate('created_at',$created_at)->where('type_doc',01)->count();
        $rechazadosB = Invoice::where('status',2)->whereDate('created_at',$created_at)->where('type_doc',03)->count();
        $rechazadosNC = Invoice::where('status',2)->whereDate('created_at',$created_at)->where('type_doc',07)->count();
       /*  $rechazadosND = Invoice::where('status',2)->where('type_doc',08)->count(); */
       $bajasp = Voided::where('status',3)->whereDate('created_at',$created_at)->count();
       $bajasr = Voided::where('status',5)->whereDate('created_at',$created_at)->count();
       $bajaspr= Voided::where('status',8)->whereDate('created_at',$created_at)->count();
        $array = [
            'pendientes' => $pendientes,
            'pendienteF' => $pendienteF,
            'pendienteB' => $pendienteB,
            'pendienteNC' => $pendienteNC,
            /* 'pendienteND' => $pendienteNB, */
            'rechazados' => $rechazados,
            'rechazadosF' => $rechazadosF,
            'rechazadosB' => $rechazadosB,
            'rechazadosNC' => $rechazadosNC,
            /* 'rechazadosND' => $rechazadosND, */
            'bajasp' => $bajasp,
            'bajasr' => $bajasr,
            'bajaspr' => $bajaspr,
        ];
        return $array;
    }
}
