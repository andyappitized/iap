@extends(Config::get('inapppurchase::views.layout'))

@section('content')
<div class="col-lg-12">
	<h2>Add Promo Code</h2>
	{{ Form::open(array('route' => 'promo.store')) }}
		@include('inapppurchase::promo-codes.partials._promo-code')
	{{ Form::close() }}
</div>
@stop
