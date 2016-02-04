<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}?>
<?php
require_once("../../config/config.php");

if($_POST['fileName']) {
	$file = $_POST['fileName'];
    $path = FOLDER_UPLOADS . $file;
    if (unlink($path)) {
		echo "OK";
	} else {
		echo "ERROR";
	}
} else {
	echo "NO";
}
?>