<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CustomRequest extends Model {

	public $wood,$handling,$material,$comment,$files,$price;

	function __construct($wood,$handling,$material,$comment,$files) {
		$this->wood = $wood;
		$this->handling = $handling;
		$this->material = $material;
		$this->comment = $comment;
		$this->files = $files;

		$this->descr = DB::table("service")->where("id",$wood)->first()->name.", ";
		$this->descr = $this->descr.DB::table("service")->where("id",$handling)->first()->name.", ";
		$this->descr = $this->descr.DB::table("service")->where("id",$material)->first()->name.", ";
		$this->descr = $this->descr.$comment;

		$this->price = 0;
		$this->price += intval(DB::table("service")->where("id",$wood)->first()->price);
		$this->price += intval(DB::table("service")->where("id",$handling)->first()->price);
		$this->price += intval(DB::table("service")->where("id",$material)->first()->price);

	}
}
