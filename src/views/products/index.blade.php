@extends(Config::get('inapppurchase::views.layout'))

@section(Config::get('inappurchase::views.content'))
<div class="container">

<div class="col-lg-12">
<h2>In App Purchase Products</h2>
<a href="{{route('promo.create')}}" class="btn btn-default">Add Product</a>
	<table class="table table-hover">
	<thead>
		<th>Product Key</th>
		<th>Product Name</th>
		<th>Consumable?</th>
		<th>Actions</th>
	</thead>
	<tbody>
		@foreach($products as $product)
			<tr>
				<td>{{$product->product_key}}</td>
				<td>{{$product->product_name}}</td>
				<td>{{ ($product->consumable == true) ? 'Yes' : 'No'}}</td>
				<td>
					<a href="{{route('promo.edit', array($product->id)) }}" class="btn btn-default pull-left">Edit</a>
					{{ Form::open(array('url' => 'iap/' . $product->id, 'class' => 'pull-left')) }}
						{{ Form::hidden('_method', 'DELETE') }}
						{{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
					{{ Form::close() }}
				</td>
			</tr>
		@endforeach
	</tbody>
	</table>
</div>

{{ $products->links() }}

</div>
