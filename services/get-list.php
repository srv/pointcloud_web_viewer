<?php

// Return value
$list = "error";

// Create a handler for the directory
$handler = opendir("../data");

// Open directory and walk through the filenames
$results = array();
while ($file = readdir($handler)) {
	// If file isn't this directory or its parent, add it to the results
	if ($file != "." && $file != "..") {
		$results[] = $file;
	}
}

// Tidy up: close the handler
closedir($handler);

// Mount output
$list = implode(",", $results);

// Return the list
echo $_GET['callback'] . '('.json_encode($list).')';
?>