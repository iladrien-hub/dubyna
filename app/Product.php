<?php

namespace App;

use Exception;
use Illuminate\Support\Facades\DB;

class Product {

	public $code, $name, $price, $discounted;

	static public function createFromDatabase($code) {
		$resp = DB::table("product")->where("code",$code)->get();
		if (sizeof($resp) == 1) 
			$resp = $resp[0];
		else 
			throw new Exception("object with code '$code' not found in database", 1);
		$obj = new Product();
		$obj->code = $code;
		$obj->name = $resp->name;
		$obj->price = $resp->price;
		$obj->discounted = $resp->discounted;
		return $obj;
	}

	static public function createFromParam($code,$name,$price,$discounted) {
		$obj = new Product();
		$obj->code = $code;
		$obj->name = $name;
		$obj->price = $price;
		$obj->discounted = $discounted;
		return $obj;
	}

}