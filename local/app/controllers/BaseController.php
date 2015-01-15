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

	}

}
