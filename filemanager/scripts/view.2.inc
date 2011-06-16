<channel>
<?php
	echo "<title>檔案列表</title>\r\n\r\n";

	$pageStart = 0;
	unset($queryLevel);
	unset($tagName);
	unset($tagCount);

	$siteURLprefix = '';
	foreach($videos as $video) {
		$title = $video[0];
		$link  = $siteURLprefix . trim($video[1]);
		$image = '';
		$data  = ' [' . $video[5] . ' ' . sprintf('%04o', ($video[4] & 0x0FFF)) . " $video[3]] $video[2]";
		//$extra contains the regular expression for filtering file names
		//$extra = '';

		$note  = $video[6];
		include('04_query.inc');
	}
?>
</channel>

<?php
	// refresh
	$params  = str_replace('&', '&amp;', $_SERVER['QUERY_STRING']);
	$currUrl = $scriptsURLprefix . '/' . $myName . '.php?' . $params;
	echo "<refreshItem>\r\n";
	echo "\t<link>$currUrl</link>\r\n";
	echo "</refreshItem>\r\n";

	// Go to copyDest
	$pageStart = 0;
	$queryLevel = '';
	$tagName = 'goCopyDestItem';
	unset($tagCount);
	$dirVarFullname   = 'copyDest';
	$dirVarFile       = '"複製目的位置"';
	$extraForFunction = '"' . $extra . '"';
	include('04_query.items.functions.inc');

	// Go to moveDest
	$pageStart = 0;
	$queryLevel = '';
	$tagName = 'goMoveDestItem';
	unset($tagCount);
	$dirVarFullname   = 'moveDest';
	$dirVarFile       = '"移動目的位置"';
	$extraForFunction = '"' . $extra . '"';
	include('04_query.items.functions.inc');

	// Go to /tmp/usbmounts
	$pageStart = 0;
	$queryLevel = '';
	$tagName = 'goUsbMountsItem';
	unset($tagCount);
	$dirVarFullname   = '"/tmp/usbmounts"';
	$dirVarFile       = '"USB Mounts"';
	$extraForFunction = '"' . $extra . '"';
	include('04_query.items.functions.inc');

	// Go to the selected directory
	$pageStart = 0;
	$queryLevel = '';
	$tagName = 'chdirItem';
	unset($tagCount);
	$dirVarFullname   = 'getStringArrayAt(fullnameArray, goItemIndex)';
	$dirVarFile       = 'getStringArrayAt(fileArray, goItemIndex)';
	$extraForFunction = '"' . $extra . '"';
	include('04_query.items.functions.inc');

	// Generate one run link for all files
	$pageStart = 0;
	$queryLevel = '.run.query';
	$tagName = 'runItem';
	unset($tagCount);
	$dirVarFullname   = 'getStringArrayAt(fullnameArray, goItemIndex)';
	$dirVarFile       = 'getStringArrayAt(fileArray, goItemIndex)';
	$extraForFunction = '""';
	include('04_query.items.functions.inc');

	// Generate one copy link for all files
	$pageStart = 0;
	$queryLevel = '.copy.query';
	$tagName = 'copyItem';
	unset($tagCount);
	$dirVarFullname   = 'getStringArrayAt(fullnameArray, goItemIndex)';
	$dirVarFile       = 'getStringArrayAt(fileArray, goItemIndex)';
	$extraForFunction = 'copyDest';
	include('04_query.items.functions.inc');

	// Generate one move link for all files
	$pageStart = 0;
	$queryLevel = '.move.query';
	$tagName = 'moveItem';
	unset($tagCount);
	$dirVarFullname   = 'getStringArrayAt(fullnameArray, goItemIndex)';
	$dirVarFile       = 'getStringArrayAt(fileArray, goItemIndex)';
	$extraForFunction = 'moveDest';
	include('04_query.items.functions.inc');

	// Generate one rename link for all files
	$pageStart = 0;
	$queryLevel = '.rename.query';
	$tagName = 'renameItem';
	unset($tagCount);
	$dirVarFullname   = 'getStringArrayAt(fullnameArray, goItemIndex)';
	$dirVarFile       = 'getStringArrayAt(fileArray, goItemIndex)';
	$extraForFunction = 'renameDest';
	include('04_query.items.functions.inc');

	// Generate one delete link for all files
	$pageStart = 0;
	$queryLevel = '.delete.query';
	$tagName = 'deleteItem';
	unset($tagCount);
	$dirVarFullname   = 'getStringArrayAt(fullnameArray, goItemIndex)';
	$dirVarFile       = 'getStringArrayAt(fileArray, goItemIndex)';
	$extraForFunction = '""';
	include('04_query.items.functions.inc');

	// Generate one mkdir link for all files
	$pageStart = 0;
	$queryLevel = '.mkdir.query';
	$tagName = 'mkdirItem';
	unset($tagCount);
	$dirVarFullname   = 'currDir';
	$dirVarFile       = 'currDir';
	$extraForFunction = 'mkdirDest';
	include('04_query.items.functions.inc');
?>
