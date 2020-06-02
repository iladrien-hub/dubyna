<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller {

    function validateCoupon(Request $request) {
    	$resp = sizeof(DB::table("coupon")->where("number",$request->input('code'))->get());
		return response()->json(array('msg'=> $resp > 0 ), 200);
    }

	function addProduct(Request $request){
		$product = $request->input('code');
		if (!in_array( $product, $_SESSION["cart"])){
			array_push($_SESSION["cart"], $product);
			return response()->json(array('msg'=> True), 200);
		}
		return response()->json(array('msg'=> False), 200);
	}

	function removeProduct(Request $request){
		$product = $request->input('code');
		if (in_array( $product, $_SESSION["cart"])){
			$_SESSION["cart"] = array_flip( $_SESSION["cart"]);
			unset ( $_SESSION["cart"][$product]);
			$_SESSION["cart"] = array_flip( $_SESSION["cart"]);
			return response()->json(array('msg'=> True), 200);
		}
		return response()->json(array('msg'=> False), 200);
	}

	function removeSpecialProduct(Request $request){
		$key = $request->input('key');
		if (isset($_SESSION["special_cart"][$key])){
			unset($_SESSION["special_cart"][$key]);
			return response()->json(array('msg'=> True), 200);
		}
		return response()->json(array('msg'=> False), 200);
	}

}
