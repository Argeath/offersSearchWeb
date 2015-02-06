<ol class="breadcrumb">
  <li><a href="/car/{{ $brand }}">{{ $brand }}</a></li>
  <li><a href="/car/{{ $brand }}/{{ $model }}">{{ $model }}</a></li>
  <li class="active">{{ $year }}</li>
</ol>

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
			<div class="panel-body">
				<div id="wykres-ceny" style="height: 250px;"></div>
			</div>
		</div>
	</div>

<script>
$(function () {
    $('#wykres-ceny').highcharts({
        chart: {
            type: 'scatter'
        },
        title: {
            text: 'Cena od przebiegu'
        },
        yAxis: {
            title: {
                text: 'Cena'
            }
        },
        xAxis: {
            title: {
                text: 'Przebieg'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    'Przebieg: ' + this.x.format() +'<br/>' +
                    'Cena: ' + ': ' + this.y.format();
            }
        },
        plotOptions: {
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function (e) {
                            $('#offersTable').DataTable().search(this.x.format()).draw();
                        }
                    }
                },
                marker: {
                    lineWidth: 1
                }
            }
        },
        series: [
        	@foreach($ceny as $typ)
        	{
	        	showInLegend: false,
	        	name: '{{ $typ['name'] }}',
	        	data: [
		        @foreach ($typ['data'] as $cena)
					[ {{ $cena["milage"] }}, {{ $cena["price"] }} ],
				@endforeach
		        ],
    		},
    		@endforeach
    	]
    });
});
</script>

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