@extends('layout')

@section('content')

<h1>Atskaite “Pasūtījumu tipi”</h1>
<table class="table table-hover">
	<thead>
		<tr>
			<th scope="col">Klienta nosaukums</th>
			<th scope="col">Piegādes adrese</th>
		</tr>
	</thead>
	<tbody>
		@foreach($multipleDel as $deliveries)
		<tr>
			<td>{{ $deliveries->Name }}</td>
			<td>{{ $deliveries->Title }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

@endsection