@extends('layout')

@section('content')

	<h1>Atskaite “Neaktīvie klienti”</h1>
	<table class="table table-hover">
	<thead>
		<tr>
			<th scope="col">Klienta nosaukums</th>
			<th scope="col">Piegādes adrese</th>
		</tr>
	</thead>
	<tbody>
		@foreach($report3 as $report)
		<tr>
			<td>{{ $report->Name }}</td>
			<td>{{ $report->Title }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection