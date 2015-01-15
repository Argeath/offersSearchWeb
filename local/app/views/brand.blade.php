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
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				Modele
			</div>
			<div class="panel-body">
				@foreach($models as $model)
					<div class="panel">
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