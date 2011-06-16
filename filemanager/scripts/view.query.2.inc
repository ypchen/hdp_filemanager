<?php
	ini_set('user_agent', $userAgent);

	if ($dataTotal > 0) {
		$siteURLprefix = '';
		foreach($lines as $line) {

			$trln  = str_replace('  ', '　',
						trim(
							str_replace("\t", '　', htmlentities($line))));
			$title = $trln;
			$link  = '';
			$extra = '';

			$image  = '';
			$note   = array();
			$note[] = '';
			$note[] = '';
			$note[] = '';
			$note[] = '';

			include('04_query.items.show.inc');
		}
	}
?>
