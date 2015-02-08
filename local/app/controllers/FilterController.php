<?php

class FilterController extends BaseController {
	public function doSetFilter() {
		$this->layout->main = "";
		$year = [Input::get('yearFrom', 0), Input::get('yearTo', 2100)];
		$milage = [Input::get('milageFrom', 0), Input::get('milageTo', 500000)];
		$power = [Input::get('powerFrom', 0), Input::get('powerTo', 1500)];
		$price = [Input::get('priceFrom', 0), Input::get('priceTo', 500000)];
		$wojewodztwo = Input::get('wojewodztwo', 'wszystkie');

		Cache::put('FilterYearFrom', $year[0], 60 * 24 * 7);
		Cache::put('FilterYearTo', $year[1], 60 * 24 * 7);
		Cache::put('FilterMilageFrom', $milage[0], 60 * 24 * 7);
		Cache::put('FilterMilageTo', $milage[1], 60 * 24 * 7);
		Cache::put('FilterPowerFrom', $power[0], 60 * 24 * 7);
		Cache::put('FilterPowerTo', $power[1], 60 * 24 * 7);
		Cache::put('FilterPriceFrom', $price[0], 60 * 24 * 7);
		Cache::put('FilterPriceTo', $price[1], 60 * 24 * 7);
		Cache::put('FilterWojewodztwo', $wojewodztwo, 60 * 24 * 7);

		return Redirect::back();
	}
}