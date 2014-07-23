<?php
/**
 * linky configuration file
 * @author aerouk
 * © aerouk 2014
 */

define('APPLICATION_NAME', "linky"); # Shown in page titles
define('APPLICATION_URL', ""); # Include a trailing slash at the end. E.g. http://google.com/

define('DATABASE_HOST', ""); # Database hostname/ip address
define('DATABASE_USER', ""); # Database username
define('DATABASE_PASS', ""); # Database password
define('DATABASE_NAME', ""); # Database name

/*  -  DO NOT EDIT BELOW THIS LINE  -  */

$connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
