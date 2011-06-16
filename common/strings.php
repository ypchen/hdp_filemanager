<?php
	// Global variables
	$userAgentIE8     = 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C)';
	$userAgentFF3     = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; zh-TW; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16';
	$userAgentChrome  = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.16 (KHTML, like Gecko) Chrome/10.0.648.205 Safari/534.16';

	$caption_length   = '影片長度';
	$caption_publish  = '發佈時間';
	$caption_view     = '觀看次數';
	$caption_eval     = '觀眾評價';

	// 86400 x 3
	$allowedSeconds   = 259200;
?>
<?php
	// Functions

	function str_between($string, $start, $end) {
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0)
			return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}
?>
