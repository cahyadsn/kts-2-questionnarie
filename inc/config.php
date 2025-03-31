<?php
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME     : inc/config.php
AUTHOR       : CAHYA DSN
CREATED DATE : 2017-12-12
UPDATED DATE : 2025-04-01 05:54:43
DEMO SITE    : http://psycho.cahyadsn.com/kts
SOURCE CODE  : https://github.com/cahyadsn/kts-2-questionnarie
================================================================================
This program is free software; you can redistribute it and/or modify it under the
terms of the MIT License.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

See the MIT License for more details

copyright (c) 2017-2025 by cahya dsn; cahyadsn@gmail.com
================================================================================ */
//-- 
define('_ISONLINE',false);
//-- assets folder
define('_ASSET','../assets/');
$c=isset($_SESSION['c'])?$_SESSION['c']:(isset($_GET['c'])?$_GET['c']:'indigo');
$page=isset($_SESSION['page'])?$_SESSION['page']:0;
$num_perpage=7;
$_SESSION['author'] = 'cahyadsn';
$_SESSION['ver']    = sha1(rand());
$version    = '0.3';                  //<-- version number
header('Expires: '.date('r'));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
//-- database configuration
$dbhost='localhost';
$dbuser='root';
$dbpass='';
$dbname='psycho';
//-- database connection
$db=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
