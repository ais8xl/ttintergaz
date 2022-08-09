@extends('layout')

@section('content')

<h1>Atskaite “Pēdējā piegāde”</h1>
<table class="table table-hover">
	<thead>
		<tr>
			<th scope="col">Klienta nosaukums</th>
			<th scope="col">Piegādes adrese</th>
			<th scope="col">Pasūtījuma datums</th>
			<th scope="col">Pasūtījuma tips</th>
			<th scope="col">Pasūtījuma visu preču summa</th>
		</tr>
	</thead>
	<tbody>
		@foreach($report2 as $info)
		<tr>
			<td>{{ $info->Name }}</td>
			<td>{{ $info->Title }}</td>
			<td>{{ $info->Date }}</td>
			<td>{{ $statuses[$info->Type-1] }}</td>
			<td>{{ $info->Price }} EUR</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection