<?php

class Helper {
	public static function secondsToText($sec, $maxHours = false, $minMins = false) {
		$text = "";
		if ($sec < 60) {
			$text = $sec . "s";
			return $text;
		}
		$min = floor($sec / 60);
		$sec = $sec % 60;
		if ($min < 60) {
			$text = $min . "m " . $sec . "s";
			return $text;
		}
		$hr = floor($min / 60);
		$min = $min % 60;
		if (!$maxHours) {
			if ($hr < 24) {
				if ($minMins) {
					$text = $hr . "h " . $min . "m";
				} else {
					$text = $hr . "h " . $min . "m " . $sec . "s";
				}

				return $text;
			}
			$ds = floor($hr / 24);
			if ($ds > 1) {
				$minMins = true;
			}

			$hr = $hr % 24;
			if ($ds > 9) {
				$text = $ds . "d " . $hr . "h";
			} else {
				if ($minMins) {
					$text = $ds . "d " . $hr . "h " . $min . "m";
				} else {
					$text = $ds . "d " . $hr . "h " . $min . "m " . $sec . "s";
				}
			}
		} else {
			if ($hr > 100) {
				$text = $hr . "h";
			} else {
				if ($minMins) {
					$text = $hr . "h " . $min . "m";
				} else {
					$text = $hr . "h " . $min . "m " . $sec . "s";
				}
			}
		}

		return $text;
	}
}