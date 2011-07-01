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

	if (!isset($note))
		$note = '';

	$linkAll = $scriptsURLprefix . '/' . $myBaseName .
		$queryLevel . '.php?uid=' . $user_id  . '&amp;query=' . $pageStart .
		',' . urlencode($link) .
		',' . urlencode($title) .
		',' . urlencode($extra);

	if($title != ''){
		echo
			"<" . $tagName . $tagCountStr . ">\r\n" .
				"\t<title>"      . $title   . $data . "</title>\r\n" .
				"\t<link>"       . $linkAll . "</link>\r\n" .
				"\t<note>"       . $note    . "</note>\r\n" .
				"\t<data>"       . $data    . "</data>\r\n" .
				"\t<site_link>"  . $link    . "</site_link>\r\n" .
				"\t<site_extra>" . $extra   . "</site_extra>\r\n" .
				"\t<image>"      . $image   . "</image>\r\n" .
			"</" . $tagName . $tagCountStr . ">\r\n";
	}
?>
