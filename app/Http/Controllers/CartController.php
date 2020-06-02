<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller {
    
	function commit(Request $request) {

		if(sizeof($_SESSION["cart"]) == 0 && sizeof($_SESSION["special_cart"]) == 0)
			return view("message",["msg" => "Отакої! Здається, у Вас пустий кошик."]);

		try {
			$pib = $request->input("pib");
			$email = $request->input("email");
			$phone = $request->input("phone");
			$adress = $request->input("adress");
			$coupon = $request->input("coupon");
			$comment = $request->input("comment") ?? "";

			$total = 0;

			$order = [];
			foreach ($_SESSION["cart"] as $item) {
				$product = Product::createFromDatabase($item);
				$total += $product->price;
				array_push($order, [ "product" => $product, "count" => $request->input($item."_count") ]);
			}
			$order_str = serialize($order);
			foreach ($_SESSION["special_cart"] as $item)
				$total += $item->price;
			$special_order_str = serialize($_SESSION["special_cart"]);

			DB::table('orders')->insert([
				"pib" => $pib,
				"email" => $email,
				"mobile" => $phone,
				"adress" => $adress,
				"comment" => $comment,
				"cart" => $order_str,
				"special_cart" => $special_order_str,
				"coupon" => $coupon,
				"total" => $total
			]);
			unset($_SESSION["special_cart"]);
			unset($_SESSION["cart"]);
		} catch (\Illuminate\Database\QueryException  $e) {
			return view("message",["msg" => "Лишенько! Трапилась якась непередбачувана помилка! Перевірте, будь ласка, правильність введених даних."]);
		}

		return view("message",["msg" => "Ваше замовлення успішно додане в обробку! :)"]);
	}

}
