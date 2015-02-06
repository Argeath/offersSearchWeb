<?php

class GeoHelper {
	public static $wojewodztwa = [
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
}