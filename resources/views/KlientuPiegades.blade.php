@extends('layout')

@section('content')

<h1>Klientu Piegades</h1>
<table class="table table-hover">
	<thead>
		<tr>
			<th scope="col">Client</th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
		@foreach($clDel as $info)
		<tr>
			<td id="client_name">{{ $info->Name }}</td>
			<td></td>
			<th>Piegādes adrese: </th>
			<td>{{ $info->Title }}</td>			
		</tr>
		<tr>
			<td></td>
			<td></td>
			<th>Piegādes datums: </th>
			<td>{{ $info->Date }}</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<th>Preču summa: </th>
			<td>{{ $info->QTY }}</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<th>Piegādes status: </th>
			<td>{{ $statuses[$info->Status-1] }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection