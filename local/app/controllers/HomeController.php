<?php

class HomeController extends BaseController {

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

	public function showWelcome() {
		$this->layout->main = View::make('dashboard');
		$this->layout->title = "Podgląd";

		$offers = DB::table('cars')->count();
		$this->layout->main->offers = $offers;

		$date = new \DateTime("-1 days");
		$offers24h = DB::table('cars')->where('data', '>', $date)->count();
		$this->layout->main->offers24h = $offers24h;

		$markiDane = DB::table('cars')->select(DB::raw('count(*) as count, brand'))->groupBy('brand')->get();
		$this->layout->main->markiDane = $markiDane;

		$modeleDane = DB::table('cars')->select(DB::raw('count(*) as count, brand, model'))->groupBy('model')->get();
		$this->layout->main->modeleDane = $modeleDane;
	}

}
