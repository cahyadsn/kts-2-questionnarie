<?php
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME     : result.php
AUTHOR       : CAHYA DSN
CREATED DATE : 2017-12-12
UPDATED DATE : 2017-12-13
DEMO SITE    : http://cahyadsn.dev.php.id/psycho/kts
SOURCE CODE  : https://github.com/cahyadsn/kts-2-questionnarie
================================================================================
This program is free software; you can redistribute it and/or modify it under the 
terms of the GNU General Public License as published by the Free Software 
Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY 
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR 
A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

copyright (c) 2017 by cahya dsn; cahyadsn@gmail.com
================================================================================ */
session_start();
if(isset($_POST['d'])){
	include 'inc/config.php';
	$c=isset($_SESSION['c'])?$_SESSION['c']:(isset($_GET['c'])?$_GET['c']:'indigo');
	$page=isset($_SESSION['page'])?$_SESSION['page']:0;
	$num_perpage=10;
	$_SESSION['author'] = 'cahyadsn';
	$_SESSION['ver']    = sha1(rand());
	$version    = '0.1';                  //<-- version number
	header('Expires: '.date('r'));
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', FALSE);
	header('Pragma: no-cache');
	$data=array(
		array('t1'=>'E','t2'=>'I','g'=>array(1,8,15,22,29,36,43,50,57,64)), 
		array('t1'=>'S','t2'=>'N','g'=>array(2,9,16,23,30,37,44,51,58,65,3,10,17,24,31,38,45,52,59,66)),
		array('t1'=>'T','t2'=>'F','g'=>array(3,11,18,25,32,39,46,53,60,67,5,12,19,26,33,40,47,54,61,68)),
		array('t1'=>'J','t2'=>'P','g'=>array(6,13,20,27,34,41,48,55,62,69,7,14,21,28,35,42,49,56,63,70))
	);
	$r=array();
	foreach($_POST['d'] as $k=>$d){
		if(in_array($k,$data[0]['g'])){
			if(!isset($r[$data[0]['t1']])){
				$r[$data[0]['t1']]=0;
				$r[$data[0]['t2']]=0;
			}
			$r[$data[0]['t1']]+=($d==1||$d==3?1:($d==2?0.5:0));
			$r[$data[0]['t2']]+=($d==5||$d==3?1:($d==4?0.5:0));
		}elseif(in_array($k,$data[1]['g'])){
			if(!isset($r[$data[1]['t1']])){
				$r[$data[1]['t1']]=0;
				$r[$data[1]['t2']]=0;
			}
			$r[$data[1]['t1']]+=($d==1||$d==3?1:($d==2?0.5:0));
			$r[$data[1]['t2']]+=($d==5||$d==3?1:($d==4?0.5:0));
		}if(in_array($k,$data[2]['g'])){
			if(!isset($r[$data[2]['t1']])){
				$r[$data[2]['t1']]=0;
				$r[$data[2]['t2']]=0;
			}
			$r[$data[2]['t1']]+=($d==1||$d==3?1:($d==2?0.5:0));
			$r[$data[2]['t2']]+=($d==5||$d==3?1:($d==4?0.5:0));
		}if(in_array($k,$data[3]['g'])){
			if(!isset($r[$data[3]['t1']])){
				$r[$data[3]['t1']]=0;
				$r[$data[3]['t2']]=0;
			}
			$r[$data[3]['t1']]+=($d==1||$d==3?1:($d==2?0.5:0));
			$r[$data[3]['t2']]+=($d==5||$d==3?1:($d==4?0.5:0));
		}
	}
	$persen=array();
	foreach($r as $k=>$v){
		$persen[$k]=round(($v/($k=='E'||$k=='I'?10:20)),2)*100;
	}
	$code=($r['E']>$r['I']?'E':'I').($r['S']>$r['N']?'S':'N').($r['T']>$r['F']?'T':'F').($r['J']>$r['P']?'J':'P');
	session_destroy();
	$sql="	SELECT * 
			FROM kts_en_interprestations a
			JOIN kts_en_temperaments b ON b.id=a.id_temperament
			WHERE a.symbol='{$code}'";
	$result=$db->query($sql);
	$row=$result->fetch_object();
}else{
	header('location:index.php');
}
?>
?>
<!DOCTYPE html>
<html>
  <head>
    <title>KTS®-II Questionnarie</title>
	<meta charset="utf-8" />
    <meta http-equiv="expires" content="<?php echo date('r');?>" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="content-language" content="en" />
	<meta name="author" content="Cahya DSN" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
	<meta name="keywords" content="Keirsey, Temperament, Sorter ,KTS , Questionnarie, personality, test" />
	<meta name="description" content="The Keirsey Temperament Sorter®-II (KTS®-II) Questionnarie ver <?php echo $version;?> created by cahya dsn" />
	<meta name="robots" content="index, follow" />
	<link rel="shortcut icon" href="<?php echo _ASSET;?>img/favicon.ico" type="image/x-icon">
	<?php if(defined('_ISONLINE') && _ISONLINE):?>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-<?php echo $c;?>.css" media="all" id="kts_en_css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
	<?php else:?>
	<link rel="stylesheet" href="<?php echo _ASSET;?>css/w3/w3.css">
	<link rel="stylesheet" href="<?php echo _ASSET;?>css/w3/w3-theme-<?php echo $c;?>.css" media="all" id="kts_en_css">
	<script src="<?php echo _ASSET;?>js/jquery.min.js"></script>
	<?php endif;?>
	<style>body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif} td.incomplete {color:red !important;}</style>
  </head>
  <body>
  <div class="w3-top">
  <div class="w3-bar w3-theme-d5">
    <span class="w3-bar-item"># KTS®-II v<?php echo $version;?></span>
    <a href="index.php" class="w3-bar-item w3-button">Home</a>
		<div class="w3-dropdown-hover">
		  <button class="w3-button">Themes</button>
		  <div class="w3-dropdown-content w3-white w3-card-4" id="theme">
				<?php
				$color=array("black","brown","pink","orange","amber","lime","green","teal","purple","indigo","blue","cyan");
				foreach($color as $c){
					echo "<a href='#' class='w3-bar-item w3-button w3-{$c} color' data-value='{$c}'> </a>";
				}
				?>	
			</div>
		</div>
	</div>
</div>  
<div class="w3-container">
    <div class="w3-card-4">
      <div class='w3-container'>
        <h2>&nbsp;</h2>
        <h2 class="w3-text-theme">The Keirsey Temperament Sorter®-II (KTS®-II) Result</h1>
        <div class="w3-row">
		<!--pre><?php print_r($r);print_r($persen);print_r($code);print_r($row);?></pre//-->
		<h3 class='w3-theme-l3 w3-padding'>Temperament : <?php echo $row->temperament;?> (<?php echo $row->code;?>)</h3>
		<h4>Overview</h4>
		<p><?php echo $row->overview;?></p>
		<h4>All <?php echo $row->temperament;?> share the following core characteristics:</h4>
		<ul>
		<li><?php $characters=explode('|',$row->characteristic);echo implode('</li><li>',$characters);?></li>
		</ul>
		<h4>Portrait of the <?php echo $row->temperament;?></h4>
		<p><?php echo implode('</p><p>',explode('|',$row->content));?></p>
		<h3 class='w3-theme-l3 w3-padding'>Personality type : <?php echo $row->short;?> (<?php echo $row->symbol;?>)</h3>
		<p><?php $personality=explode('|',$row->description);echo implode('</p><p>',$personality);?></p>
		<h4>Finding Your Passion or What Makes a Job Right for You?</h4>
		<p><?php echo $row->temperament.' - '.$row->finding;?></p>
		<p><?php echo $row->passion;?></p>
		<h4>Dealing with Stress from Work: <?php echo $row->temperament;?></h4>
		<p>How do you deal with work-related stress? Each personality type has different stressors and copes in different ways. Better understanding of your own stressors and coping mechanisms can help you reduce the tension and anxiety work stress often creates.</p><p><?php echo $row->dealing;?></p>
		<p><?php $stress=explode('|',$row->stress);echo implode('</p><p>',$stress);?></p>
		</div>
		<h6>&nbsp;</h6/>
		<div class='w3-theme-l2 w3-padding'><b>source code (v0.1) </b> : Not yet Avalilable <!--a href='https://github.com/cahyadsn/kts'>https://github.com/cahyadsn/kts</a//--></div>
        <h2>&nbsp;</h2>
		
      </div>
    </div>		
</div>
<div class="w3-bottom">
	<div class="w3-bar w3-theme-d4 w3-center w3-padding">
		KTS®-II Questionnarie v<?php echo $version;?> copyright &copy; 2017<?php echo (date('Y')>2017?date('-Y'):'');?> by <a href='mailto:cahyadsn@gmail.com'>cahya dsn</a><br />
	</div>
</div>
<script src="<?php echo _ASSET;?>js/kts.en.v1.php?v=<?php echo md5(filemtime(_ASSET.'js/kts.en.v1.php'));?>"></script>     
</body>
</html>