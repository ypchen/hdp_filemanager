<?php
	if (!isset($pageStart) || ($pageStart < 0))
		$pageStart = 1;

	if (!isset($queryLevel))
		$queryLevel = '.query';

	if (!isset($tagName) || (strlen($tagName) == 0))
		$tagName = 'item';

	if (!isset($tagCount) || ($tagCount < 0)) {
		$tagCountStr = '';
	}
	else {
		$tagCountStr = strval($tagCount);
	}

	echo "<" . $tagName . $tagCountStr . ">\r\n";
	echo "\t<link>\r\n";
	echo "\t\t<script>\r\n";
	echo "\t\t\tmyLink = \"" . $scriptsURLprefix . '/' . $myBaseName .
		$queryLevel . '.php?uid=' . $user_id . '&amp;query=' . $pageStart .
			'," + urlEncode(' . $dirVarFullname . ') + ' .
			'"," + urlEncode(' . $dirVarFile . ') + ' .
			'"," + urlEncode(' . $extraForFunction . ");\r\n";
	echo "\t\t\tmyLink;\r\n";
	echo "\t\t</script>\r\n";
	echo "\t</link>\r\n";
	echo "</" . $tagName . $tagCountStr . ">\r\n";
?>
