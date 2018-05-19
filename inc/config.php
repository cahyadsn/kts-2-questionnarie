<?php
/************************************
FILENAME	: inc/config.php
AUTHOR		: CAHYA DSN
CREATED DATE: 2017-12-02
UPDATED DATE: 2018-05-20
*************************************/
//-- 
define('_ISONLINE',false);
//-- assets folder
define('_ASSET','assets');
//-- database configuration
$dbhost='localhost';
$dbuser='root';
$dbpass='';
$dbname='psycho';
//-- database connection
$db=new mysqli($dbhost,$dbuser,$dbpass,$dbname);