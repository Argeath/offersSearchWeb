<?php

class ModelController extends BaseController {

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

	public function showBrand($brand) {
		$this->layout->main = View::make('brand');
		$this->layout->title = $brand;

		$models = DB::table('cars')->where('brand', '=', $brand)->distinct()->orderBy('model', 'asc')->lists('model');
		$this->layout->main->models = $models;
		$this->layout->main->brand = $brand;

		$offers = DB::table('cars')->where('brand', '=', $brand)->count();
		$this->layout->main->offers = $offers;

		$date = new \DateTime("-1 days");
		$offers24h = DB::table('cars')->where('brand', '=', $brand)->where('data', '>', $date)->count();
		$this->layout->main->offers24h = $offers24h;

		$ceny = DB::table('cars')->select(DB::raw('round(avg(price)) as avg, model'))->where('brand', '=', $brand)->groupBy('model')->get();
		$this->layout->main->ceny = $ceny;

		$modeleDane = DB::table('cars')->select(DB::raw('count(*) as count, model'))->where('brand', '=', $brand)->groupBy('model')->get();
		$this->layout->main->modeleDane = $modeleDane;

	}

	public function showModel($brand, $model) {
		$this->layout->main = View::make('empty');
	}

}
