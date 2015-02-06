<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<table id="offersTable">
				<thead>
					<th>Link</th>
					<th>Marka</th>
					<th>Model</th>
					<th>Rocznik</th>
					<th>Przebieg</th>
					<th>Moc</th>
					<th>Typ silnika</th>
					<th>Typ nadwozia</th>
					<th>Miasto</th>
					<th>Cena</th>
					<th>Czas</th>
				</thead>
				<tbody>
				@foreach($offers as $offer)
					<tr>
					<td><a target="_blank" href="http://olx.pl/oferta/-{{ $offer['specId'] }}.html"><i class="glyphicon glyphicon-new-window"></i></a></td>
					<td>{{ $offer['brand'] }}</td>
					<td>{{ $offer['model'] }}</td>
					<td>{{ $offer['year'] }}</td>
					<td>{{ OffersHelper::shortedMilage($offer['milage']) }}</td>
					<td>{{ $offer['power'] }}</td>
					<td>{{ $offer['fuel'] }}</td>
					<td>{{ $offer['bodyType'] }}</td>
					<td>{{ OffersHelper::cleanAddress($offer['address']) }}</td>
					<td>{{ OffersHelper::cleanInt($offer['price']) }}</td>
					<td>{{ $offer['data'] }}</td>
					</tr>
				@endforeach
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
$(function() {
	$("#offersTable").DataTable({
		"order": [10, 'desc'],
	});
});
</script>