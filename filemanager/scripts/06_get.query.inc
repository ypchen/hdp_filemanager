<?php
	$query = '';
	$page = 1;
	$search = '';
	unset($cat);
	unset($extra);
	if(isset($_GET['query'])) {
		$query = $_GET['query'];
		$queryArr = explode(',', $query);
		$page = $queryArr[0];
		$search = urldecode($queryArr[1]);
		if (count($queryArr) > 2)
			$cat = urldecode($queryArr[2]);
		if (count($queryArr) > 3)
			$extra = urldecode($queryArr[3]);
	}
?>
