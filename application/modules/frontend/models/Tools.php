<?php
Class Tools {


	public function getElapsedTime($dateTimeFrom,$dateTimeTo,$opt = false){ //"2016-02-27 15:00:00"
		// test local timezone
		//$d = new DateTime('now');
		//debug( $d->format('c e') );


		// check sub or add hour summer is magic
		$d = new DateTime('now');
		$d->format(DateTime::ISO8601);
		$timezonestr = $d->format('c'); //2016-02-28T00:46:04+01:00
		$checkparam = substr($timezonestr, -6);
		debug($timezonestr);


		$datetime1 = new DateTime($dateTimeFrom);
		$datetime1->format(DateTime::ISO8601);
		debug('date from: '.$dateTimeFrom);

		$datetime2 = new DateTime($dateTimeTo);
		$datetime2->format(DateTime::ISO8601);
		debug('date to: '.$dateTimeTo);
		$difference = $datetime1->diff($datetime2);

		switch ($opt){
			case 'xx':
				$str = '';
			break;
			default:
				$diffDays = $difference->d ? $difference->d.'j':'';
				$str = 'Il reste '.$diffDays.$difference->h.'h'.$difference->i.'m';
			break;
		}
		debug($difference);
		return $str;
/*		echo 'Difference: '.$difference->y.' years, '
				.$difference->m.' months, '
						.$difference->d.' days'
								.$difference->h.' hours';
		echo '<pre>';
		print_r($difference);*/

	}

}


