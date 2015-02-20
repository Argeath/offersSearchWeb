<?php

class GeoHelper {
	public static $states = [
		'Pomorskie',
		'Zachodniopomorskie',
		'Kujawsko-pomorskie',
		'Warmińsko-mazurskie',
		'Lubelskie',
		'Lubuskie',
		'Podlaskie',
		'Wielkopolskie',
		'Mazowieckie',
		'Małopolskie',
		'Opolskie',
		'Podkarpackie',
		'Dolnośląskie',
		'Śląskie',
		'Łódzkie',
		'Świętokrzyskie',
	];

	public static function getLatLong($address) {

		$address = str_replace(' ', '+', $address);
		$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&sensor=false';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$geoloc = curl_exec($ch);

		$json = json_decode($geoloc);
		return array($json->results[0]->geometry->location->lat, $json->results[0]->geometry->location->lng);

	}

	public static function getDistanceBetween($from, $to) {
		try {
			$pos1 = GeoHelper::getLatLong($from);
			$pos2 = GeoHelper::getLatLong($to);
			$lat1 = $pos1[0];
			$lat2 = $pos2[0];
			$theta = $pos1[1] - $pos2[1];

			$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);

			$miles = $dist * 60 * 1.1515;
			$kms = $miles * 1.609344;

			return round($kms);
		} catch (Exception $e) {
			echo $e;
		}
	}

	public static function getUserLocation() {
		$ip = $_SERVER['REMOTE_ADDR'];
		$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
		return $details->city;
	}

	public static function getDistanceTo($to) {
		$loc = GeoHelper::getUserLocation();
		return GeoHelper::getDistanceBetween($loc, $to);
	}

	public static function extractState($str, $elem = 1) {
		$txt = OffersHelper::cleanAddress($str, $elem);

		if($txt == "") {
			return false;
		}

		$states = array_map('strtolower', GeoHelper::$states);
		if(in_array(strtolower($txt), $states)) {
			return ucfirst(strtolower($txt));
		}

		$looking = substr(strtolower($txt), 0, 7);
		foreach($states as $state) {
			if($looking == substr($state, 0, 7)) {
				return ucfirst($state);
			}
		}

		if($elem < 3) {
			return GeoHelper::extractState($str, ++$elem);
		}
		return false;
	}

	public static function extractStates() {
		$offers = DB::table('cars')->whereNull('state')->orderBy('data', 'DESC')->limit(10000)->get();
		$updates = [];
		foreach($offers as $offer) {
			$state = GeoHelper::extractState($offer['address']);
			if($state) {
				$updates[$offer['id']] = $state;
			}
		}
		
		DB::beginTransaction();
		foreach($updates as $id => $state) {
			DB::table('cars')->where('id', '=', $id)->update(array('state' => $state));
		}
		DB::commit();
	}
}