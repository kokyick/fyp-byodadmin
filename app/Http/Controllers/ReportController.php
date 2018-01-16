<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Library\Api;

use PDF;

class ReportController extends Controller
{

    public function htmltopdfview(Request $request)
    {
        $start=$request->reportstart;
        $end=$request->reportend;
        $outl_id=(int)$request->outl_id;

        $myBody['startdate'] = $request->reportstart;
        $myBody['enddate'] = $request->reportend;
        //dd($outl_id);
        $result =Api::postRequest("PostOutletReport?outletID=" . $outl_id,$myBody);
        // dd($result);
        $OrderList = json_decode( $result, true );

        // if ($OrderList!=null){
        //     $OrderList=array_reverse($OrderList);
        // }

        // $products = Products::all();,
        view()->share('OrderList',$OrderList);
        view()->share('myBody',$myBody);
        if($request->has('download')){
            $pdf = PDF::loadView('app.report');
            return $pdf->download('app.report');
        }
        return view('app.report');
    }
}
