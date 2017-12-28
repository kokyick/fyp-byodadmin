<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Library\Api;

use Session;

class HomeController extends Controller
{
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**public function __construct()
    *{
     *   $this->middleware('auth');
    *}
	*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
	public function viewindex()
    {
        return view("app.index");
    }
	public function viewindex1()
    {
        return view("app.index-1");
    }
	public function viewpayment()
    {
        //Menus
        $OList =Api::getRequest("GetOutletOrders?outletID=" . 13);
        $OrderList = json_decode( $OList, true );
        return view("app.payment", compact('OrderList'));
    }
	public function viewfeedback()
    {
        return view("app.feedback");
    }
	public function viewterms()
    {
        return view("app.terms");
    }
	public function viewregistration()
    {
        return view("app.registration");
    }
	public function viewlogin()
    {
        return view("app.login");
    }


}
