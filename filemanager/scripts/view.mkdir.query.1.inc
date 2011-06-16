<?php
	$itemYPC           = 21.5;
	$itemWidthPC       = 95;
	$itemHeightPC      = 3.8;
	$rowCount          = 17;
	$itemPerPage       = $rowCount;

	$statusAdjYPC      = -0.7;
	$statusAdjHeightPC = 0.4;

	$fontSizeText      = 12;
	$fontSizeHint      = 12;
	$fontSizeStatus    = 12;

	$statusLines       = 2;
	$statusAlign       = 'left';

	include('06_get.query.inc');

	$link  = $search;

	//$link is "currDir" already
	//chdir(dirname($link));
	chdir($link);
	$command = 'mkdir "' . $extra . '" 2>&1';
	$shell_output = runExternal($command, $code, $link);
	$lines = explode("\n",
				"Execute command: [$command]\n" .
				"Code = $code (0: Ok)\n" .
				"----- OUTPUT BEGIN -----\n" .
				$shell_output .
				"----- OUTPUT END -----"
			);

	$dataTotal = count($lines);
	if ($dataTotal > 0) {
		$itemTotal = $dataTotal;
	}
	else {
		// for floor(log10($itemTotal)) calculation
		$itemTotal = 1;
	}
?>
