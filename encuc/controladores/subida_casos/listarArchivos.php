<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}?>
<?php
require_once("../../config/config.php");

$dir = FOLDER_UPLOADS;
$dh  = opendir($dir);

while (false !== ($filename = readdir($dh))) {
	if (($filename != '..') && ($filename != '.')) {
    	$files[]= $filename;
	}
}


echo json_encode($files);


?>