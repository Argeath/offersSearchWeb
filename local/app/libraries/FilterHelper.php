<?php

class FilterHelper {
	public static function getFilters() {
		$year = [Cache::get('FilterYearFrom', 0), Cache::get('FilterYearTo', 2100)];
		$milage = [Cache::get('FilterMilageFrom', 0), Cache::get('FilterMilageTo', 500000)];
		$power = [Cache::get('FilterPowerFrom', 0), Cache::get('FilterPowerTo', 1500)];
		$price = [Cache::get('FilterPriceFrom', 0), Cache::get('FilterPriceTo', 500000)];
		$state = Cache::get('FilterState', 'wszystkie');

		return ['year' => $year,
			'milage' => $milage,
			'power' => $power,
			'price' => $price,
			'state' => $state];
	}
}