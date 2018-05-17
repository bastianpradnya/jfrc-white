<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	echo "<script language='javascript'>
          window.location.href = '../client/index.php'
          </script>
            ";
	header('Location:client/index.php');
	exit;
?>
Something is wrong :-(
