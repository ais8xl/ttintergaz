@extends('layout')

@section('content')

<h1>Klientu Saraksts</h1>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col"></th>
            <th scope="col">Address</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientName as $name)
        <tr>
            <td id="name_{{ $name->ID }}">{{ $name->Name }}</td>
            <td>
              <button type="button" class="btn btn-primary" onclick="showClientAddress({{ $name->ID }})">Parādīt adreses</button>
              <a href="KlientuPiegades{{ $name->ID }}" class="btn btn-outline-primary" role="button" aria-disabled="true" id="deliveryName_{{ $name->ID }}">Atvērt piegādes</a>
            </td>
            <td id="address_{{ $name->ID }}"></td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
  function showClientAddress(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax( {
        type:'POST',
        url:"{{ route('ajaxRequest.post') }}",
        data:{id_client:id},

        success:function(data) {
          $(`#address_${id}`).text(data);
        }
    });
  }
</script>
@endsection