<?php
class DateLib extends App_Model_Std {

	/**
	 * @return ecart date
	 */
	public function _getDelay($since, $to = false) {
		$timeNow = $to ? new Zend_Date($to) : new Zend_Date();
		$timeThen = new Zend_Date($since);
		$difference = $timeNow->sub($timeThen);
		return $difference->toValue();
	}

	public function _friendlySeconds($allSecs, $format = false) {
		$seconds = $allSecs % 60; $allMinutes = ($allSecs - $seconds) / 60;
		$minutes = $allMinutes % 60; $allHours = ($allMinutes - $minutes) / 60;
		$hours =  $allHours % 24; $allDays = ($allHours - $hours) / 24;
		if(!$format){
			return ($allDays > 0 ? $allDays . "d" : "") .
			($hours > 0 ? $hours . "h" : "") .
			($minutes > 0 ? $minutes . "m" : "") . $seconds . "s";
		} else {
			switch ($format){
				case 'secondes':
					return $allSecs;
				break;

				case 'jours':
					return $allDays;
				break;
			}
		}

	}



	//echo "It happened " . _friendlySeconds(_getDelay('2015-06-25')) . " ago.";


	/**
	 * @return relative time
	 */
	public function _getRelativeTime($date,$compare = false, $fromdate = false) {
		// Déduction de la date donnée à la date actuelle
		$time = $fromdate ? strtotime($fromdate) - strtotime($date) : time() - strtotime($date);

		// Calcule si le temps est passé ou à venir
		if ($time > 0) {
			$when = "il y a";
		} else if ($time < 0) {
			$when = "dans environ";
		} else {
			if(!$compare){
				return "il y a 1 seconde";
			}
		}
		if($compare){
			return $time > 0 || $time == 0 ? 'earlier':'later';
		}

		$time = abs($time);

		// Tableau des unités et de leurs valeurs en secondes
		$times = array( 31104000 =>  'an{s}',       // 12 * 30 * 24 * 60 * 60 secondes
				2592000  =>  'mois',        // 30 * 24 * 60 * 60 secondes
				86400    =>  'jour{s}',     // 24 * 60 * 60 secondes
				3600     =>  'heure{s}',    // 60 * 60 secondes
				60       =>  'minute{s}',   // 60 secondes
				1        =>  'seconde{s}'); // 1 seconde

		foreach ($times as $seconds => $unit) {
			// Calcule le delta entre le temps et l'unité donnée
			$delta = round($time / $seconds);

			// Si le delta est supérieur à 1
			if ($delta >= 1) {
				// L'unité est au singulier ou au pluriel ?
				if ($delta == 1) {
					$unit = str_replace('{s}', '', $unit);
				} else {
					$unit = str_replace('{s}', 's', $unit);
				}
				// Retourne la chaine adéquate
				if(!$compare){
					return $when." ".$delta." ".$unit;
				}
			}
		}
	}

}