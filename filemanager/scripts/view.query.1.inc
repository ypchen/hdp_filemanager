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
	$lines = file($link);

	$dataTotal = count($lines);
	if ($dataTotal > 0) {
		$itemTotal = $dataTotal;
	}
	else {
		// for floor(log10($itemTotal)) calculation
		$itemTotal = 1;
	}
?>
