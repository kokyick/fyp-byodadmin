<?php

namespace App\Http\Controllers;

use App\Library\Api;

use Illuminate\Http\Request;

use Log;

use Session;

class CartController extends Controller
{
  public function AddCart(Request $request)
  {
	//Check if its the same outlet
	//Check if items is already added
    //Add product to session cart
	$quan=$request->foodQuantity;
	$outId=$request->outletid;
	$itemid=$request->itemid;
	$itemname=$request->itemname;
	$itemprice=$request->itemprice;
	$itemproduct_image=$request->itemproduct_image;
	$itemfood_type=$request->itemfood_type;	
	$itemmerchant_id=$request->itemmerchant_id;
	//delete all session data
	//Session::flush();
	//new product to be added
	$product=collect(['quantity' => $quan, 'outletid' => $outId, 'itemid' =>$itemid, 'itemname' =>$itemname, 'itemprice' =>$itemprice, 'itemproduct_image' =>$itemproduct_image, 'itemfood_type' =>$itemfood_type, 'itemmerchant_id' =>$itemmerchant_id]);
	//retrieve old cart
	//if(Session::has('cart')){
		//$oldcart=Session::get('cart');
		//append to oldcart with new items
		//$newcart=array_push($oldcart,$product);
		//store in session
		//Session::push('cart', $newcart); 
	//}
	//else{
	//Check if its the same outlet
	//Check if its the same food in cart
	$isin=false;
	if(Session::has('cart')){
		foreach (Session::get('cart') as $food){
			if($food['itemid']==$product['itemid']){
				$food['quantity']+=$product['quantity'];
				$isin=true;
			}
		}
	}
	if($isin==false)
		Session::push('cart', $product); 
	//}

    return redirect()->route('menus', ['id'=>$outId]);
  }
  public function vieworderhist()
  {
	$Orders =Api::getRequest("GetOutletOrders?outletID=" . 13);
	$OrdersItem = json_decode( $Orders, true );
	//dd($OrdersItem);
	return $OrdersItem;
  }
  public function removefood($id)
  {
	//Single Menus
	$Outlet =Api::postRequest("RemoveOrderFood?foodOrderedID=" . $id,null);
	return redirect()->route('viewpayment');
  }
    public function singleorder($id)
  {
	//Single Menus
	$Outlet =Api::getRequest("Orders?orderid=" . $id);
	$OutletItem = json_decode( $Outlet, true );
	return $OutletItem;
  }
  public function cancelOrder(Request $request)
  {
	//Single Menus
	$Outlet =Api::postRequest("CancelOrder?orderId=" . $request->orderId,null);
    return redirect()->route('viewpayment');
  }
  public function orderPaid(Request $request)
  {
	//Single Menus
	$Outlet =Api::postRequest("CashPaid?orderId=" . $request->orderId,null);
    return redirect()->route('viewpayment');
  }
}