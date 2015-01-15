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
							{{ $offers or 0 }}
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
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Marki
			</div>
			<div class="panel-body">
				<div id="wykres-marki" style="height: 250px;"></div>
			</div>
		</div>
	</div>

<script>
new Morris.Donut({
	element: 'wykres-marki',
	data: [
		@foreach ($markiDane as $marka)
			{ label: "{{ $marka["brand"] }}", value: {{ $marka["count"] }} },
		@endforeach
	],
	labels: ['Ofert']
});
</script>

	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Najczęstsze modele
			</div>
			<div class="panel-body">
				<div id="wykres-modele" style="height: 250px;"></div>
			</div>
		</div>
	</div>
</div>

<script>
new Morris.Donut({
	element: 'wykres-modele',
	data: [
		@foreach ($modeleDane as $model)
			@if ($model["count"] > ($offers/200))
				{ label: "{{ $model["brand"]." ".$model["model"] }}", value: {{ (int)$model["count"] }} },
			@endif
		@endforeach
	],
	labels: ['Ofert']
});
</script>