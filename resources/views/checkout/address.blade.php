@extends('layouts.app')

@section('content')
	<div class="container">
		@include('checkout._step')

		<div class="row">
			<div class="col-xs-8">
				<div class="panel panel-default">
					<div class="panel-heading">Alamat Pengiriman</div>
					<div class="panel-body">
						@include('checkout._address-new-form')
					</div>
				</div>
			</div>
			<div class="col-xs-4">
				@include('checkout._cart-panel')
			</div>
		</div>
	</div>
@endsection