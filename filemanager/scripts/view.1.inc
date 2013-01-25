<?php
	$itemYPC           = 21.5;
	$itemWidthPC       = 47.5;
	$itemHeightPC      = 3.8;
	$rowCount          = 17;
	$columnCount       = 2;

	$statusAdjYPC      = -0.7;
	$statusAdjHeightPC = 0.4;

	$statusLines        = 1;
	$statusAlign        = 'left';

	ini_set('user_agent', $userAgent);

	include('06_get.query.inc');

	// Set the timezone
	date_default_timezone_set('Asia/Taipei');

	if (strlen($search) == 0)
		$dir = '/usr/bin';
	else
		$dir = $search;

	$fileCount = 0;

	if ($dh = opendir($dir)) {
		// Change to use 'ls -a1' now (NOT ls -al)
		// Creating an array needs too much memory
		closedir($dh);

		$link = "ls -a1 \"$dir\"";
		$command = $commandNice . $link . ' 2>&1';
		$shell_output = runExternal($command, $code);

		$videos = explode("\n", $shell_output);

		echo "<script>\r\n";
		echo "\tfileArray     = null;\r\n";
		echo "\tfullnameArray = null;\r\n";

		if (strcmp($dir, '/') == 0) {
			$fileCount ++;
			$file = '.';
			$fullname = '/';
			echo "\tfileArray     = pushBackStringArray(fileArray, \"" . $file . "\");\r\n";
			echo "\tfullnameArray = pushBackStringArray(fullnameArray, \"" . $fullname . "\");\r\n";
		}

		foreach($videos as $video) {

			$file = str_replace("\n", '', $video);

			if (strcmp($file, '.') == 0)
				continue;

			if ((strcmp($file, '..') == 0) && (strcmp($dir, '/') == 0))
				continue;

			if (
				(strcmp($file, '..') == 0) ||
				!isset($extra) ||
				(strlen($extra) == 0) ||
				(preg_match($extra, $file) == 1)
			) {
				if (strcmp($dir, '/') == 0)
					$fullname = $dir . $file;
				else {
					$fullname = $dir . '/' . $file;
					if (strcmp($file, '..') == 0)
						$fullname = realpath($fullname);
				}

				$fileCount ++;
				echo "\tfileArray     = pushBackStringArray(fileArray, \"" . $file . "\");\r\n";
				echo "\tfullnameArray = pushBackStringArray(fullnameArray, \"" . $fullname . "\");\r\n";
			}
		}

		echo "</script>\r\n";
	}

	$itemTotal = $fileCount;

	//No need to check
	//include('05_check.base.inc');
?>
