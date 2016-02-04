<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}?>
<?php
require_once("../../config/config.php");
// upload.php
if (empty($_FILES['subirArchivo'])) {
    return; // or process or throw an exception
}

// get the files posted
$file = $_FILES['subirArchivo'];

// a flag to see if everything is ok
$success = null;

    $target = FOLDER_UPLOADS . $file['name'];
    if(move_uploaded_file($file['tmp_name'], $target)) {
        $success = true;
    } else{
        $success = false;
        break;
    }

// check and process based on successful status 
if ($success === true) {

    // store a successful response (default at least an empty array). You
    // could return any additional response info you need to the plugin for
    // advanced implementations.
    $output = 'OK';
} elseif ($success === false) {
    $output = 'ERROR';
    // delete any uploaded files
    unlink($file);
} else {
    $output = 'NO';
}

// return a json encoded response for plugin to process successfully
echo json_encode($output);
?>