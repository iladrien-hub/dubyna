<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomRequest;
use Illuminate\Support\Facades\DB;

class CustomRequestController extends Controller {

    public function getForm() {
        $services = [
            "apple"         => DB::table("service")->where("id","apple")->first(),
            "ash"           => DB::table("service")->where("id","ash")->first(),
            "birch"         => DB::table("service")->where("id","birch")->first(),
            "metal"         => DB::table("service")->where("id","metal")->first(),
            "no"            => DB::table("service")->where("id","no")->first(),
            "oil"           => DB::table("service")->where("id","oil")->first(),
            "other_handling"=> DB::table("service")->where("id","other_handling")->first(),
            "other_material"=> DB::table("service")->where("id","other_material")->first(),
            "other_wood"    => DB::table("service")->where("id","other_wood")->first(),
            "resin"         => DB::table("service")->where("id","resin")->first(),
            "varnish"       => DB::table("service")->where("id","varnish")->first(),
            "wood_material" => DB::table("service")->where("id","wood_material")->first()
        ];
    	return view("custom", ["services" => $services]);
    }

    public function upload(Request $request) {
        $files = [];
    	foreach ($request->file() as $file)
    		foreach ($file as $f) {
                $name = time().'_'.$f->getClientOriginalName();
                $f->move(storage_path("app/public"), $name);
                array_push($files, $name);
            }
            // new CustomRequest($request->input("wood"),$request->input("handling"),$request->input("material"),$request->input("comment"), $files)
        array_push($_SESSION["special_cart"],new CustomRequest($request->input("wood"),$request->input("handling"),$request->input("material"),$request->input("comment"), $files));
    	return redirect("cart");
    }
}
