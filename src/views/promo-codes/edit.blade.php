@extends('admin.layout')

@section('content')
<h1>Edit Promo Code</h1>
{{ Form::model($code, array('route' => 'promo.store')) }}
	@include('inapppurchase::promo-codes.partials._promo-code')
{{ Form::close() }}
@stop