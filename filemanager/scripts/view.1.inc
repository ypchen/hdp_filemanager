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

	$videos = array();

	if (strlen($search) == 0)
		$dir = '/usr/bin';
	else
		$dir = $search;

	if ($dh = opendir($dir)) {

		if (strcmp($dir, '/') == 0) {
			try {
				$file = '.';
				$fullname = '/';
				$video = array(
					$file,
					$fullname,
					date('Y-md H:i:s', filemtime($fullname)),
					filesize($fullname),
					fileperms($fullname),
					filetype($fullname),
					$dir,
				);
				$videos[] = $video;
			}
			catch (Exception $e) {
				//echo 'Caught exception: ' . $e->getMessage() .
			}
		}

		while (($file = readdir($dh)) !== false) {
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

				try {
					$video = array(
						$file,
						$fullname,
						date('Y-md H:i:s', filemtime($fullname)),
						filesize($fullname),
						fileperms($fullname),
						filetype($fullname),
						$dir,
					);
					$videos[] = $video;
				}
				catch (Exception $e) {
					//echo 'Caught exception: ' . $e->getMessage() .
				}
			}
		}
		closedir($dh);
	}

	usort($videos, "cmp_filename");

	$itemTotal = count($videos);
	//No need to check
	//include('05_check.base.inc');

	echo "<script>\r\n";
	echo "\tfileArray     = null;\r\n";
	echo "\tfullnameArray = null;\r\n";
	foreach($videos as $video) {
		echo "\tfileArray     = pushBackStringArray(fileArray, \"" . $video[0] . "\");\r\n";
		echo "\tfullnameArray = pushBackStringArray(fullnameArray, \"" . $video[1] . "\");\r\n";
	}
	echo "</script>\r\n";
?>
<?php
	function cmp_filename($a, $b) {
		return (strcmp($a[0], $b[0]));
	}
?>
