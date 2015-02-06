<?php

class OffersController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	 */

	public function showNewest() {
		$this->layout->main = View::make('offers.newest');
		$this->layout->title = "Najnowsze oferty";

		$offers = DB::table('cars')->where('condition', '=', 'Nieuszkodzony')->orderBy('data', 'DESC')->limit(300)->get();
		$this->layout->main->offers = $offers;
	}

}
