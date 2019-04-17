<div class="panel-body">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">TilausID</th>
      <th scope="col">AsiakasID</th>
      <th scope="col">TuoteID</th>
      <th scope="col">Tilausaika</th>
    </tr>
  </thead>
  <tbody>

@foreach ($tilaukset as $tilaus)

    <tr class="bg-success">
      <th scope="row">{{ $tilaus->TilausID }}</th>
      <td>{{ $tilaus->FK_asiakasID }}</td>
      <td>{{ $tilaus->FK_tuoteID }}</td>
	<td>{{ $tilaus->tilausaika }}</td>
    </tr>

@endforeach

  </tbody>
</table>
                </div>
            </div>
        </div>
    </div>
</div>
