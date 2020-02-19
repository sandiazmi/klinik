<?php
if(empty($_SESSION['SES_USER'])) {
	// Refresh
	if (!isset($_SESSION['SES_USER'])) {
		 header("Location: pages/login.php");
	  }
}
?>