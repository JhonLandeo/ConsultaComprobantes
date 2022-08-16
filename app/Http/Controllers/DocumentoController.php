<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use App\Models\Guide;
use App\Models\Invoice;
use App\Models\Liquidation;
use App\Models\Purchase;
use App\Models\Quote;
use App\Models\SalesOrder;
use App\Models\Voided;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
       $aprobados = Invoice::where('status',1)->whereDate('created_at',$created_at)->count();
        $aprobadoF = Invoice::where('status',1)->whereDate('created_at',$created_at)->where('type_doc',01)->count();
        $aprobadoB = Invoice::where('status',1)->whereDate('created_at',$created_at)->where('type_doc',03)->count();
        $aprobadoNC = Invoice::where('status',1)->whereDate('created_at',$created_at)->where('type_doc',07)->count();

        $rechazados = Invoice::where('status',2)->whereDate('created_at',$created_at)->count();
        $rechazadosF = Invoice::where('status',2)->whereDate('created_at',$created_at)->where('type_doc',01)->count();
        $rechazadosB = Invoice::where('status',2)->whereDate('created_at',$created_at)->where('type_doc',03)->count();
        $rechazadosNC = Invoice::where('status',2)->whereDate('created_at',$created_at)->where('type_doc',07)->count();
       /*  $rechazadosND = Invoice::where('status',2)->where('type_doc',08)->count(); */
       $bajasp = Voided::where('status',3)->whereDate('created_at',$created_at)->count();
       $bajasr = Voided::where('status',5)->whereDate('created_at',$created_at)->count();
       $bajaspr= Voided::where('status',8)->whereDate('created_at',$created_at)->count();
       $bajasa= Voided::where('status',4)->whereDate('created_at',$created_at)->count();
       $bajasp6= Voided::where('status',6)->whereDate('created_at',$created_at)->count();
       $bajaspr7= Voided::where('status',7)->whereDate('created_at',$created_at)->count();

       $pendienteR = Invoice::where('status',3)->whereDate('created_at',$created_at)->count();
        $pendienteRF = Invoice::where('status',3)->whereDate('created_at',$created_at)->where('type_doc',01)->count();
        $pendienteRB = Invoice::where('status',3)->whereDate('created_at',$created_at)->where('type_doc',03)->count();
        $pendienteRNC = Invoice::where('status',3)->whereDate('created_at',$created_at)->where('type_doc',07)->count();

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
            'bajasa' => $bajasa,
            'bajasp6' => $bajasp6,
            'bajaspr7' => $bajaspr7,

            'aprobados' => $aprobados,
            'aprobadoF' => $aprobadoF,
            'aprobadoB' => $aprobadoB,
            'aprobadoNC' => $aprobadoNC,

            'pendienteR' => $pendienteR,
            'pendienteRF' => $pendienteRF,
            'pendienteRB' => $pendienteRB,
            'pendienteRNC' => $pendienteRNC,

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
        $array=array();
        for ($i=1; $i <= 12 ; $i++) { 
            $data = Invoice::where('status',1)
            ->whereMonth('invoices.created_at',$i)
            /* ->where('type_doc','!=',00) */
            ->count();      
            array_push($array,$data);
        }
        return $array;
    }
    public function getEnterprise()
    {
        $arrayClient = array();
        for ($i=1; $i <=12 ; $i++) { 
            $data = Enterprise::where('status',1)
            ->whereMonth('enterprises.created_at',$i)
            ->count(); 
            array_push($arrayClient, $data);   
        }
        return $arrayClient;
    }
    public function topClient()
    {
        $arrayTop = array();
        for ($i=1; $i <=12 ; $i++) { 
            $data = Invoice::join('enterprises as e', 'invoices.enterprise_id' , '=' ,'e.id')
            ->select(DB::raw('count(*) as cantidad, business_name'))
            ->whereMonth('invoices.created_at',$i)
            ->whereYear('invoices.created_at',2022)
            /* ->where('type_doc','!=',00) */    
            ->groupBy('e.business_name')
            ->orderBy('cantidad','desc')
            ->take(1)
            ->get();
            array_push($arrayTop,$data);
        }
             
        return $arrayTop;
    }
    public function list()
    {
        $data = array();
        
            $datos = Invoice::join('enterprises as e', 'invoices.enterprise_id' , '=' ,'e.id')
            ->select(DB::raw('count(*) as cantidad, business_name'))
            /* ->whereMonth('invoices.created_at',$i)
            ->whereYear('invoices.created_at',2022) */
            ->where('type_doc','!=',00)    
            ->groupBy('e.business_name')
            ->orderBy('cantidad','desc')
            ->get();
        
      
        $json_data = array(
            "data" => $datos,
        );
             
        return $json_data;
    }
}
