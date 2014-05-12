<div class="form-group">
	{{ Form::label('Product') }}
	{{ Form::select('product_key', $products, null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
	{{ Form::label('Promotional Code') }}
	{{ Form::text('code', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
	{{ Form::label('Quantity') }}
	{{ Form::text('quantity',1, array('class' => 'form-control')) }}
</div>
<div class="form-group">
	{{ Form::label('Expires') }}
	{{ Form::text('expires', null, array('placeholder' => 'e.g. 2014-05-01', 'class' => 'form-control')) }}
</div>
<div class="form-group">
	{{ Form::submit('Create', array('class' => 'btn btn-lg btn-success')) }}
	<a href="javascript:history.go(-1)" class="btn btn-lg btn-danger">Cancel</a>
</div>