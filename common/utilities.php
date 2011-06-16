<?php
	// Global variables
?>
<?php
	// Functions

	function notification_email_text($subject, $body) {
		global $imsBotEmail, $imsAdminEmail;

		$to = $imsAdminEmail;
		$headers = "From: $imsBotEmail";
		return mail($to, $subject, $body, $headers);
	}

	function yp_cmp_strings($a, $b) {
		$aLen = strlen($a);
		$bLen = strlen($b);

		if ($aLen < $bLen)
			return (-1);

		if ($aLen > $bLen)
			return (1);

		return strcmp($a, $b);
	}

	function yp_cmp_videos($a, $b) {
		// Compare their titles
		return yp_cmp_strings($a[1], $b[1]);
	}

	function yp_cmp_videos_2($a, $b) {
		// Compare their titles
		$aexp = explode('/', $a[1]);
		$bexp = explode('/', $b[1]);
		return yp_cmp_strings(trim($aexp[0]), trim($bexp[0]));
	}

	// This function is obtained from
	// http://www.php.net/manual/en/function.shell-exec.php#52826
	function runExternal($cmd, &$code, $working_dir = '/') {
		$descriptorspec = array(
			0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
			1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
			2 => array("pipe", "w")   // stderr is a file to write to
		);

		$pipes = array();
		$process = proc_open($cmd, $descriptorspec, $pipes, $working_dir);

		$output = "";

		if (!is_resource($process)) return false;

		#close child's input imidiately
		fclose($pipes[0]);

		stream_set_blocking($pipes[1],false);
		stream_set_blocking($pipes[2],false);

		$todo = array($pipes[1],$pipes[2]);

		while( true ) {
			$read = array();
			if( !feof($pipes[1]) ) $read[]= $pipes[1];
			if( !feof($pipes[2]) ) $read[]= $pipes[2];

			if (!$read) break;

			$ready = stream_select($read, $write = NULL, $ex = NULL, 2);

			if ($ready === false) {
				break; #should never happen - something died
			}

			foreach ($read as $r) {
				$s = fread($r, 1024);
				$output .= $s;
			}
		}

		fclose($pipes[1]);
		fclose($pipes[2]);

		$code = proc_close($process);

		return $output;
	}
?>
