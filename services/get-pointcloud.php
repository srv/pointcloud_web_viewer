<?php

// Get the inputs
$pointcloud_file = (isset($_REQUEST['file']) ? $_REQUEST['file'] : null);

// Return value
$pc = "error";

// The file to be loaded
$filename = '../data/'.$pointcloud_file;

if (file_exists($filename)) {
    $pc = file_get_contents($filename);
}
// Return the list
echo $_GET['callback'] . '('.json_encode($pc).')';
?>