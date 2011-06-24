<?php
//	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

	require('../../common/constants.php');
	require('../../common/utilities.php');

	$userAgent        = $userAgentFF3;

	$wholeURL         = wholeURLforTheExecutedFile();
	$rawPrefixURL     = strrleft($wholeURL, '/scripts');
	$imsDirectory     = strrright($rawPrefixURL, '/');
	$scriptsURLprefix = $rawPrefixURL . '/scripts';
	$imagePrefix      = $rawPrefixURL . '/image/';

	$myScriptName     = $_SERVER['SCRIPT_NAME'];
	$remoteIP         = $_SERVER['REMOTE_ADDR'];

	$idleImagePrefix  = 'busy';

	// Default main image width and height
	$myImgWidth        = 35;
	$myImgHeight       = 35;

	// Default values
	$itemYPC           = 21.5;
	$itemWidthPC       = 50;
	$itemHeightPC      = 5.7;
	$itemPerPage       = 12;
	$rowCount          = 12;
	$columnCount       = 4;

	$statusAdjYPC      = -0.7;
	$statusAdjHeightPC = 0.4;

	$fontSizeText      = 16;
	$fontSizeHint      = 16;
	$fontSizeStatus    = 22;

	$user_id           = 0;
?>
