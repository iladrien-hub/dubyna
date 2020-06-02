<?php

namespace App\Http\Controllers;

use App\Product;
use App\CustomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller {

    public function home() {

    	$req = DB::table("product")->inRandomOrder()->take(4)->get();
    	$catalog = [];
    	foreach ($req as $item) {
    		array_push($catalog, Product::createFromParam($item->code,$item->name,$item->price,$item->discounted));
    	}
    	$req = DB::table("product")->where("discounted",1)->inRandomOrder()->take(4)->get();
    	$sale = [];
    	foreach ($req as $item) {
    		array_push($sale, Product::createFromParam($item->code,$item->name,$item->price,$item->discounted));
    	}
    	$req = DB::table("gallery")->inRandomOrder()->take(4)->get();
    	$gallery = [];
    	foreach ($req as $item) {
    		array_push($gallery, Product::createFromParam($item->code,$item->name,$item->price,0));
    	}

    	return view("home", ["catalog" => $catalog, "sale" => $sale, "gallery" => $gallery]);
    }

    public function catalog() {
    	$req = DB::table("product")->get();
    	$catalog = [];
    	foreach ($req as $item) {
    		array_push($catalog, Product::createFromParam($item->code,$item->name,$item->price,$item->discounted));
    	}
    	return view("catalog", ["catalog" => $catalog]);
    }

    public function sale() {
    	$req = DB::table("product")->where("discounted",1)->get();
    	$catalog = [];
    	foreach ($req as $item) {
    		array_push($catalog, Product::createFromParam($item->code,$item->name,$item->price,$item->discounted));
    	}
    	return view("sale", ["catalog" => $catalog]);
    }

    public function gallery() {
        $req = DB::table("gallery")->get();
        $catalog = [];
        foreach ($req as $item) {
            array_push($catalog, Product::createFromParam($item->code,$item->name,$item->price,0));
        }
        return view("gallery", ["catalog" => $catalog]);
    }

    public function cart() {
        $req = DB::table("gallery")->get();
        $catalog = [];
        foreach ($_SESSION["cart"] as $code) {
            array_push($catalog, Product::createFromDatabase($code));
        }
        return view("cart", ["catalog" => $catalog, "special" => $_SESSION["special_cart"] ]);
    }
}
