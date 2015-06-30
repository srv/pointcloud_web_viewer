<?php

/*
 *---------------------------------------------------------------
 * CONFIGURATION
 *---------------------------------------------------------------
 *
 * Different variables to be configured
 */

// The directory where your pointclouds are saved
define("DATAFOLDER", "data");

// The filenames of the pointclouds
define("PCFILE", "pc.csv");
define("PCINFO", "info.csv");
define("PCIMG", "img.png");

// Can be development or production
define("ENVIRONMENT", "development");

// The development url
define("DEVELURL", "http://localhost/srv.uib.es/pointclouds/");

// The production url
define("PRODURL", "http://srv.uib.es/pointclouds/");




/*
 *---------------------------------------------------------------
 * URL PARSER
 *---------------------------------------------------------------
 *
 * Parses the url and load the correct page.
 */

// Parse the url
include('app/helpers/url.php');
$pathInfo = parsePath();

// Load pages
if (sizeof($pathInfo['call_parts']) > 0) {
  $page = $pathInfo['call_parts'][0];
  switch ($page) {
    case 'view':
      $pcFolder = (isset($_REQUEST['c']) ? $_REQUEST['c'] : null);
      include('app/views/viewer.php');
      break;
    case '404':
      include('app/views/404.php');
      break;
    default:
      include('app/views/home.php');
      break;
  }
}
else {
  include('app/views/home.php');
}

?>