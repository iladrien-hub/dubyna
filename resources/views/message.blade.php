@extends("main")

@section("pagename"){{$msg}} @endsection

@section("content")
<style>
	.message_block {
		font-size: 40px;
		text-align: center;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%,-50%);
		line-height: 1.2;
	}
	@media screen and (max-width: 330px) {
		.message_block {
			font-size: 25px;
		}
	}
</style>
<div class="container message_block">
	{{$msg}}
</div>
@endsection