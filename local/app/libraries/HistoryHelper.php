<?php

class HistoryHelper {
	public static function getHistory($userId) {
		$history = DB::table('history')->where('user', '=', (int) $userId)->orderBy('date', 'DESC')->get();
		if ($history == null) {
			return [];
		}
		return $history;
	}

	public static function deleteOldHistory($userId) {
		$last = DB::table('history')->where('user', '=', (int) $userId)->orderBy('date', 'DESC')->skip(9)->first();
		if ($last == null) {
			return false;
		}
		DB::table('history')->where('user', '=', (int) $userId)->where('date', '<', $last['date'])->delete();
	}

	public static function addHistory($userId, $link, $title) {
		$norepeat = DB::table('history')->where('user', '=', (int) $userId)->where('link', '=', $link)->first();
		if ($norepeat != null) {
			DB::table('history')->where('id', '=', $norepeat['id'])->update(['date' => time()]);
			return false;
		}

		HistoryHelper::deleteOldHistory($userId);
		DB::table('history')->insertGetId(['user' => $userId, 'date' => time(), 'link' => $link, 'title' => $title]);
	}
}