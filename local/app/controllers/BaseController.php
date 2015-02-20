<?php

class BaseController extends Controller {

	protected $layout = "master";

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout() {
		if (!is_null($this->layout)) {
			$this->layout = View::make($this->layout);
		}
		$this->layout->title = "";

		$brands = DB::table('cars')->distinct()->orderBy('brand', 'asc')->lists('brand');
		$this->layout->brands = $brands;

		$history = HistoryHelper::getHistory(Auth::id());
		$this->layout->history = $history;

		DB::table('cars')->where('year', '<', 1950)->orWhere('milage', '>', 500000)->delete();

		$filters = FilterHelper::getFilters();

		$this->layout->year = $filters['year'];
		$this->layout->milage = $filters['milage'];
		$this->layout->power = $filters['power'];
		$this->layout->price = $filters['price'];
		$this->layout->state = $filters['state'];

		GeoHelper::extractStates();

	}

}
