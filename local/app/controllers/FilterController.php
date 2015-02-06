<?php

class FilterController extends BaseController {
	public function doSetFilter() {
		$year = [Input::get('yearFrom', 0), Input::get('yearTo', 2100)];
		$milage = [Input::get('milageFrom', 0), Input::get('milageTo', 500000)];
		$power = [Input::get('powerFrom', 0), Input::get('powerTo', 1500)];
		$price = [Input::get('priceFrom', 0), Input::get('priceTo', 500000)];
		$wojewodztwo = Input::get('wojewodztwo', 'wszystkie');

		Cache::put('FilterYear', $year, 60 * 24 * 7);
		Cache::put('FilterMilage', $milage, 60 * 24 * 7);
		Cache::put('FilterPower', $power, 60 * 24 * 7);
		Cache::put('FilterPrice', $price, 60 * 24 * 7);
		Cache::put('FilterWojewodztwo', $wojewodztwo, 60 * 24 * 7);
	}
}