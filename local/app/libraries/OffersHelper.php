<?php

class OffersHelper {
	public static function cleanAddress($address) {
		$s = str_replace(', ', ';', $address);
		$arr = explode(';', $s);
		if (count($arr) < 1) {
			return "";
		}

		if (count($arr) == 3) {
			$arr[1] = $arr[2];
			unset($arr[2]);
		}

		if (count($arr) == 5) {
			$arr[2] = $arr[4];
			unset($arr[4]);
		}

		if (count($arr) > 1) {
			$first = $arr[0];
			$i = 0;
			foreach ($arr as $k => $r) {
				if ($i > 0 && $r == $first) {
					$i = $k;
				} else {
					$i++;
				}
			}
			array_splice($arr, $i);
		}

		if (count($arr) > 1) {
			$second = $arr[1];
			$i = 0;
			foreach ($arr as $k => $r) {
				if ($i > 1 && $r == $second) {
					$i = $k;
				} else {
					$i++;
				}
			}
			array_splice($arr, $i);
		}
		foreach ($arr as $k => $r) {
			$arr[$k] = trim($r);
		}
		return $arr[0];
		//return implode($arr, ', ');
	}

	public static function cleanInt($int) {
		$nbr = number_format($int, 0, '.', ',');
		$text = $nbr . '';
		return $text;
	}

	public static function shortedMilage($milage) {
		$b = false;
		if ($milage > 1 && $milage < 1000) {
			$milage *= 1000;
			$b = true;
		}
		$str = OffersHelper::cleanInt($milage);

		if ($b) {
			$str .= ' (' . $milage / 1000 . ')';
		}

		return $str;
	}
}
