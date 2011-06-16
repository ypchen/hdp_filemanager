<?php
//	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

	require('../../common/strings.php');
	require('../../common/utilities.php');

	$userAgent         = $userAgentFF3;

	$imsDirectory      = 'filemanager';

	$scriptsURLprefix  = 'http://localhost:7711/' . $imsDirectory . '/scripts';
	$imagePrefix       = 'http://localhost:7711/' . $imsDirectory . '/image/';
	$idleImagePrefix   = 'busy';

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

	$myScriptName      = $_SERVER['SCRIPT_NAME'];
	$remoteIP          = $_SERVER['REMOTE_ADDR'];

	$user_id           = 0;
?>
<?php
	function myImage($site){
		global $imagePrefix;

		$siteComponents = explode('.', $site);
		return ($imagePrefix . '' . $siteComponents[0] . '.jpg');
	}

	function myLogo($site){
		return ('<image>' . myImage($site) . '</image>' .
			'<media:thumbnail url="' . myImage($site) .'" />');
	}
?>
