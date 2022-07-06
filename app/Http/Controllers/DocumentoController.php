<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\Invoice;
use App\Models\Liquidation;
use App\Models\Purchase;
use App\Models\Quote;
use App\Models\SalesOrder;
use App\Models\Voided;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
   
    public function index()
    {



        return view('welcome');
    }

   
    public function total($ruc, $type, $month, $year)
    {
        $factura = Invoice::join('enterprises', 'invoices.enterprise_id' , '=' ,'enterprises.id')
        ->where('number_doc',$ruc)
        ->where('type_doc',$type)
        ->whereMonth('invoices.created_at',$month)
        ->whereYear('invoices.created_at',$year)
        ->count();
        return $factura;
    }

    public function totalGuias($ruc, $type, $month, $year){
        $guias = Guide::join('enterprises', 'guides.enterprise_id' , '=' ,'enterprises.id')
        ->where('number_doc',$ruc)
        ->where('type_doc',$type)
        ->whereMonth('guides.created_at',$month)
        ->whereYear('guides.created_at',$year)
        ->count();
        return $guias;
    }
    public function totalOrdenVenta($ruc, $type, $month, $year){
        $ordenVenta = SalesOrder::join('enterprises', 'sales_order.enterprise_id' , '=' ,'enterprises.id')
        ->where('number_doc',$ruc)
        ->where('type_doc',$type)
        ->whereMonth('sales_order.created_at',$month)
        ->whereYear('sales_order.created_at',$year)
        ->count();
        return $ordenVenta;
    }
    public function totalCotizacion($ruc, $type, $month, $year){
        $cotizacion = Quote::join('enterprises', 'quote.enterprise_id' , '=' ,'enterprises.id')
        ->where('number_doc',$ruc)
        ->where('type_doc',$type)
        ->whereMonth('quote.created_at',$month)
        ->whereYear('quote.created_at',$year)
        ->count();
        return $cotizacion;
    }
    public function totalLiquidacion($ruc, $type, $month, $year){
        $liquidacion = Liquidation::join('enterprises', 'liquidation_purchase.enterprise_id' , '=' ,'enterprises.id')
        ->where('number_doc',$ruc)
        ->where('type_doc',$type)
        ->whereMonth('liquidation_purchase.created_at',$month)
        ->whereYear('liquidation_purchase.created_at',$year)
        ->count();
        return $liquidacion;
    }
    public function totalPurchase($ruc, $type, $month, $year){
        $purchase = Purchase::join('enterprises', 'purchase_order.enterprise_id' , '=' ,'enterprises.id')
        ->where('number_doc',$ruc)
        ->where('type_doc',$type)
        ->whereMonth('purchase_order.created_at',$month)
        ->whereYear('purchase_order.created_at',$year)
        ->count();
        return $purchase;
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

    public function cantidadMes($year, $month){
        $docMes = Invoice::where('status',1)
        ->whereMonth('invoices.created_at',$month)
        ->whereYear('invoices.created_at',$year)
        ->count();
        return $docMes;
    }

    public function cantidadMesDash(){
        $enero = Invoice::where('status',1)
        ->whereMonth('invoices.created_at',01)
        ->count();
        $febrero = Invoice::where('status',1)
        ->whereMonth('invoices.created_at',02)
        ->count();
        $marzo = Invoice::where('status',1)
        ->whereMonth('invoices.created_at',03)
        ->count();
        $abril = Invoice::where('status',1)
        ->whereMonth('invoices.created_at',04)
        ->count();
        $mayo = Invoice::where('status',1)
        ->whereMonth('invoices.created_at',05)
        ->count();
        $junio = Invoice::where('status',1)
        ->whereMonth('invoices.created_at',06)
        ->count();
        $julio = Invoice::where('status',1)
        ->whereMonth('invoices.created_at',07)
        ->count();
        $array = array();
        array_push($array,$enero,$febrero,$marzo,$abril,$mayo,$junio,$julio);
        return $array;
    }
}
