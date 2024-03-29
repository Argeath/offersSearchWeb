<div class="row">
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-5">
						<div class="huge">
							∞
						</div>
					</div>
					<div class="col-xs-7 text-right">
						<div class="huge">
							{{ $offersCount or 0 }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-5">
						<div class="huge">
							24h
						</div>
					</div>
					<div class="col-xs-7 text-right">
						<div class="huge">
							{{ $offers24h or 0 }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				Modele
			</div>
			<div class="panel-body">
				@foreach($models as $model)
					<div class="col-md-3 panel">
						<a href="/car/{{ $brand }}/{{ $model }}">{{ $model }}</a>
					</div>
				@endforeach
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				Średnie ceny
			</div>
			<div class="panel-body">
				<div id="wykres-ceny" style="height: 250px;"></div>
			</div>
		</div>
	</div>

<script>
new Morris.Donut({
	element: 'wykres-ceny',
	data: [
		@foreach ($ceny as $model)
			{ label: "{{ $model["model"] }}", value: {{ $model["avg"] }} },
		@endforeach
	],
	labels: ['Ofert']
});
</script>

	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				Ofert
			</div>
			<div class="panel-body">
				<div id="wykres-ofert" style="height: 250px;"></div>
			</div>
		</div>
	</div>

<script>
new Morris.Donut({
	element: 'wykres-ofert',
	data: [
		@foreach ($modeleDane as $model)
			{ label: "{{ $model["model"] }}", value: {{ $model["count"] }} },
		@endforeach
	],
	labels: ['Ofert']
});
</script>


</div>

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
		columnDefs: [
	       { type: 'numeric-comma', targets: 0 }
	     ]
	});
});
</script>