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

		$filters = FilterHelper::getFilters();

		$models = DB::table('cars')
			->whereBetween('year', $filters['year'])
			->whereBetween('milage', $filters['milage'])
			->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
			->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('condition', '=', 'Nieuszkodzony')->distinct()->orderBy('model', 'asc')->lists('model');
		
		$this->layout->main->models = $models;
		$this->layout->main->brand = $brand;

		$offersCount = DB::table('cars')
			->whereBetween('year', $filters['year'])
			->whereBetween('milage', $filters['milage'])
			->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
			->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('condition', '=', 'Nieuszkodzony')->count();
		$this->layout->main->offersCount = $offersCount;

		$date = new \DateTime("-1 days");
		$offers24h = DB::table('cars')
			->whereBetween('year', $filters['year'])
			->whereBetween('milage', $filters['milage'])
			->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
			->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('condition', '=', 'Nieuszkodzony')->where('data', '>', $date)->count();
		$this->layout->main->offers24h = $offers24h;

		$ceny = DB::table('cars')->select(DB::raw('round(avg(price)) as avg, model'))
			->whereBetween('year', $filters['year'])
			->whereBetween('milage', $filters['milage'])
			->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
			->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('condition', '=', 'Nieuszkodzony')->groupBy('model')->get();
		$this->layout->main->ceny = $ceny;

		$modeleDane = DB::table('cars')->select(DB::raw('count(*) as count, model'))
			->whereBetween('year', $filters['year'])
			->whereBetween('milage', $filters['milage'])
			->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
			->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('condition', '=', 'Nieuszkodzony')->groupBy('model')->get();
		$this->layout->main->modeleDane = $modeleDane;

		$offers = DB::table('cars')
			->whereBetween('year', $filters['year'])
			->whereBetween('milage', $filters['milage'])
			->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
			->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('condition', '=', 'Nieuszkodzony')->orderBy('data', 'DESC')->limit(300)->get();
		$this->layout->main->offers = $offers;

	}

	public function showModel($brand, $model) {
		$this->layout->main = View::make('model');
		$this->layout->title = $brand . ' ' . $model;

		$filters = FilterHelper::getFilters();

		$offersCount = DB::table('cars')
			->whereBetween('year', $filters['year'])
			->whereBetween('milage', $filters['milage'])
			->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
			->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('model', '=', $model)->where('condition', '=', 'Nieuszkodzony')->count();
		$this->layout->main->offersCount = $offersCount;

		$date = new \DateTime("-1 days");
		$offers24h = DB::table('cars')
			->whereBetween('year', $filters['year'])
			->whereBetween('milage', $filters['milage'])
			->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
			->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('model', '=', $model)->where('condition', '=', 'Nieuszkodzony')->where('data', '>', $date)->count();
		$this->layout->main->offers24h = $offers24h;

		$ceny = DB::table('cars')->select(DB::raw('round(avg(price)) as price, year'))
			->whereBetween('year', $filters['year'])
			->whereBetween('milage', $filters['milage'])
			->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
			->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('model', '=', $model)->where('condition', '=', 'Nieuszkodzony')->groupBy('year')->get();
		$this->layout->main->ceny = $ceny;

		$offers = DB::table('cars')
			->whereBetween('year', $filters['year'])
			->whereBetween('milage', $filters['milage'])
			->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
			->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('model', '=', $model)->where('condition', '=', 'Nieuszkodzony')->orderBy('data', 'DESC')->limit(300)->get();
		$this->layout->main->offers = $offers;

		$years = DB::table('cars')
			->whereBetween('year', $filters['year'])
			->whereBetween('milage', $filters['milage'])
			->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
			->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('model', '=', $model)->where('condition', '=', 'Nieuszkodzony')->distinct()->orderBy('year', 'asc')->lists('year');
		$this->layout->main->years = $years;
		$this->layout->main->brand = $brand;
		$this->layout->main->model = $model;
	}

	public function showYear($brand, $model, $year) {
		$this->layout->main = View::make('year');
		$this->layout->title = $brand . ' ' . $model . ' (' . $year . ')';
		
		$filters = FilterHelper::getFilters();

		$offersCount = DB::table('cars')
			->whereBetween('year', $filters['year'])
			->whereBetween('milage', $filters['milage'])
			->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
			->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('model', '=', $model)->where('year', '=', $year)->where('condition', '=', 'Nieuszkodzony')->count();
		$this->layout->main->offersCount = $offersCount;

		$date = new \DateTime("-1 days");
		$offers24h = DB::table('cars')
			->whereBetween('year', $filters['year'])
			->whereBetween('milage', $filters['milage'])
			->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
			->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('model', '=', $model)->where('year', '=', $year)->where('condition', '=', 'Nieuszkodzony')->where('data', '>', $date)->count();
		$this->layout->main->offers24h = $offers24h;

		$ceny = DB::table('cars')->select(DB::raw('round(avg(price)) as price, year'))
			->whereBetween('year', $filters['year'])
			->whereBetween('milage', $filters['milage'])
			->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
			->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('model', '=', $model)->where('year', '=', $year)->where('condition', '=', 'Nieuszkodzony')->groupBy('year')->get();
		$this->layout->main->ceny = $ceny;

		$offers = DB::table('cars')
			->whereBetween('year', $filters['year'])
			->whereBetween('milage', $filters['milage'])
			->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
			->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('model', '=', $model)->where('year', '=', $year)->where('condition', '=', 'Nieuszkodzony')->orderBy('data', 'DESC')->limit(300)->get();
		$this->layout->main->offers = $offers;

		$fuels = ['LPG', 'Benzyna', 'Diesel'];
		$ceny = array();
		foreach ($fuels as $fuel) {
			$c = DB::table('cars')->select(DB::raw('price, milage'))
				->whereBetween('year', $filters['year'])
				->whereBetween('milage', $filters['milage'])
				->whereBetween('power', $filters['power'])
			->where(function($query) {
				$filters = FilterHelper::getFilters();
				if($filters['state'] > 0) {
					$query->where('state', '=', GeoHelper::$states[$filters['state']-1]);
				}
			})
				->whereBetween('price', $filters['price'])->where('brand', '=', $brand)->where('model', '=', $model)->where('year', '=', $year)
			                      ->where('milage', '>', 1000)->where('fuel', '=', $fuel)->where('condition', '=', 'Nieuszkodzony')->get();
			$ceny[] = array('name' => $fuel, 'data' => $c);
		}
		$this->layout->main->ceny = $ceny;

		$this->layout->main->year = $year;
		$this->layout->main->brand = $brand;
		$this->layout->main->model = $model;
	}

}
