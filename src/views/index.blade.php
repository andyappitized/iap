<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
<div class="container">
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<p class="navbar-text">Promo Codes Manager</p>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="{{route('promo.create')}}">Add Promo Codes</a></li>
			</ul>
		</div>
	</div>
</nav>



<div class=".col-lg-12" style="padding-top: 80px;">
<h2>Promotional Codes</h2>
	<table class="table table-hover">
	<thead>
		<th>Product Key</th>
		<th>Code</th>
		<th>Expires</th>
		<th>Actions</th>
	</thead>
	<tbody>
		@foreach($codes as $code)
			<tr>
				<td>{{$code->product_key}}</td>
				<td>{{$code->code}}</td>
				<td>{{$code->expires}}</td>
				<td>
					<a href="{{route('promo.edit', array($code->id)) }}" class="btn btn-default pull-left">Edit</a>
					{{ Form::open(array('url' => 'promo/' . $code->id, 'class' => 'pull-left')) }}
						{{ Form::hidden('_method', 'DELETE') }}
						{{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
					{{ Form::close() }}
				</td>
			</tr>
		@endforeach
	</tbody>
	</table>

	
</div>

{{ $codes->links() }}

</div>