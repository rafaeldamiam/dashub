<?php
foreach (glob("application/*.app.php") as $filename){ require_once $filename;}

/* 
 * Two ways that the framework works: 
 * 1 -> paslite.com/controller/action/param1/param2/..
 * 2 -> localhost/paslite/controller/action/param1/param2/..
 */
define('APP_POSITION', 2);
// CONTROLER SET FIRST PAGE IN VIEW
define('MAIN_CONTROLLER', 'app');
//URL_BASE TAKE AUTOMATICALLY
define('URL_BASE', Services::urlBase());
//define('ACCESS', true);
define('APP_NAME', "dashub");
/*
 * This constant define which name will be on the title page
 * Position 1 -> Application Name
 * Position 2 -> Controller Name
 * Position 3 -> Action Name
 * EX: URL -> localhost(0)/PASlite(1)/controller(2)/Action(3)
 * While the user keep in the main page (without pass through a controller) it will just show the application name
 */
define('TITLE_POSITION', APP_POSITION);
//SQLITE db name
define('SQLITE_DB_NAME', 'dashub.sqlite');
//PUBLIC INPUT (UPLOAD) FOLDER 
define('UPLOAD_LOCATION', 'public/input' );
//APP Version
define('APP_VERSION', '1.1' );
