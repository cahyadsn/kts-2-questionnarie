<?php
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME     : index.php
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
include 'inc/config.php';
$c=isset($_SESSION['c'])?$_SESSION['c']:(isset($_GET['c'])?$_GET['c']:'indigo');
$page=isset($_SESSION['page'])?$_SESSION['page']:0;
$num_perpage=7;
$_SESSION['author'] = 'cahyadsn';
$_SESSION['ver']    = sha1(rand());
$version    = '0.1';                  //<-- version number
header('Expires: '.date('r'));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
if(!isset($_SESSION['kts_en_data'])){
	$sql="SELECT * FROM kts_en_statements ORDER BY rand()";
	$result=$db->query($sql);
	$data=array();
	while($row=$result->fetch_object()) $data[]=$row;
	$_SESSION['kts_en_data']=$data;
}else{
	$data=$_SESSION['kts_en_data'];
}
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
    <a href="#" class="w3-bar-item w3-button">Home</a>
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
   <form action='result.php' method='post' id='kts'>
	<input type="hidden" id="page" value="0">
    <div class="w3-card-4">
      <div class='w3-container'>
        <h2>&nbsp;</h2>
        <h2 class="w3-text-theme">The Keirsey Temperament Sorter®-II (KTS®-II) Questionnarie</h1>
        <div class="w3-row">
          <div class="w3-col s12" id='main'>
            The <b>Keirsey Temperament Sorter®-II (KTS®-II)</b> is the most widely used personality instrument in the world. It is a powerful 70 question personality instrument that helps individuals discover their personality type. The KTS-II is based on <b>Keirsey Temperament Theory™</b>, published in the best selling books, <b><i>Please Understand Me®</i></b> and <b><i>Please Understand Me II</i></b>, by <b>Dr. David Keirsey</b>.
			<div class="w3-container w3-section w3-theme-l3">
				<span onclick="this.parentElement.style.display='none'" class="w3-closebtn" style='float:right;'>x</span>	
			  <h3>Instructions</h3>
			  <p>It is important that you answer all the questions from the perspective of what feels real for you and not try to give answers that you think would sound like how you should behave in any particular situation. The objective is to understand yourself as you really are – not the way, for example, you must react in your job, or others expect you to behave. Effectiveness as an individual or leader is not based on any particular personality style. It is really about how well you know yourself and others</p>
			  <p>There are five choices for each question, which is have number 1 to 5 with meaning : (1) Absolutely (2) Kinda (3) 50/50 (4) Not Really and {5) Not at All. There are no right or wrong answers – all of the population agrees with whatever choice you make.</p>
			</div> 
          </div>
		  <h6>&nbsp;</h6>
        </div>   
		<div class="w3-row">
			<table class="w3-table w3-striped">
			  <thead>
				<tr class="w3-theme-d3">
					<th rowspan='2'>No</th>
					<th rowspan='2'>Statements</th>
					<th colspan='5'>Options</th>
				</tr>
				<tr class="w3-theme-d3">
					<th title='Absolutely'>1</th>
					<th title='Kinda'>2</th>
					<th title='50/50'>3</th>
					<th title='Not Really'>4</th>
					<th title='Not at All'>5</th>
				</tr>
			  </thead>
			  <tbody id='p0'>
				<?php
				$no=0;
				foreach($data as $d){
				  $c=rand()%5;
				  echo "
					<tr style='border-top:solid 1px #999;'>
					  <td style='width:30px !important;'>".++$no."</td>
					  <td class='right'>{$d->statement}</td>
					  <td style='padding-left:16px !important;width:30px !important;' class='incomplete' title='absolutely'><input type='radio' name='d[{$d->id}]' value='1' class='w3-radio' ".(isset($_GET['auto'])?($c==0?'checked ':''):'')."required /></td>
					  <td style='padding-left:16px !important;width:30px !important;' class='incomplete' title='Kinda'><input type='radio' name='d[{$d->id}]' value='2' class='w3-radio' ".(isset($_GET['auto'])?($c==1?'checked ':''):'')."required /></td>
					  <td style='padding-left:16px !important;width:30px !important;' class='incomplete' title='50/50'><input type='radio' name='d[{$d->id}]' value='3' class='w3-radio' ".(isset($_GET['auto'])?($c==2?'checked ':''):'')."required /></td>
					  <td style='padding-left:16px !important;width:30px !important;' class='incomplete' title='Not Really'><input type='radio' name='d[{$d->id}]' value='4' class='w3-radio' ".(isset($_GET['auto'])?($c==3?'checked ':''):'')."required /></td>
					  <td style='padding-left:16px !important;width:30px !important;' class='incomplete' title='Not at All'><input type='radio' name='d[{$d->id}]' value='5' class='w3-radio' ".(isset($_GET['auto'])?($c==4?'checked ':''):'')."required /></td>
                    </tr>
					   ";
				  if($no%$num_perpage==0) {
					echo "</tbody><tbody style='display:none' id='p".round($no/$num_perpage)."'>";
				  }
				}
				?>
			  </tbody>
			</table>
		</div>
        <div class="w3-row">
		  <h6>&nbsp;</h6>
		  <div class="w3-col s2 w3-padding">
			<button class="w3-button w3-round-large w3-theme-d1 w3-margin-8 w3-disabled" id="btn_back" disabled>prev</button>
			<button class="w3-button w3-round-large w3-theme-d1 w3-margin-8" id="btn_next">next</button>
          </div>
          <div class="w3-col s10 w3-padding">
            <input type='submit' value='process' id='btn_kirim' class='w3-button w3-round-large w3-theme-d1 w3-right w3-margin-8 w3-disabled' disabled/>
		  </div>
		</div>
		<h6>&nbsp;</h6>
		<div class='w3-theme-l2 w3-padding'><b>source code (v0.1) </b> : Not yet Avalilable <!--a href='https://github.com/cahyadsn/kts'>https://github.com/cahyadsn/kts</a//--></div>
        <h2>&nbsp;</h2>
      </div>
    </div>		
	</form>
</div>
<div class="w3-bottom">
	<div class="w3-bar w3-theme-d4 w3-center w3-padding">
		KTS®-II Questionnarie v<?php echo $version;?> copyright &copy; 2017<?php echo (date('Y')>2017?date('-Y'):'');?> by <a href='mailto:cahyadsn@gmail.com'>cahya dsn</a><br />
	</div>
</div>
<div id="warning" class="w3-modal">
  <div class="w3-modal-content">
    <header class="w3-container w3-red"> 
      <span onclick="document.getElementById('warning').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
      <h2>Warning</h2>
    </header>
    <div class="w3-container">
      <p id='msg'></p>
    </div>
    <footer class="w3-container w3-border-top w3-padding-16 w3-light-grey">
      <a href='#' onclick="document.getElementById('warning').style.display='none'" class="w3-button w3-grey">close</a>
    </footer>
  </div>
</div>
<script src="<?php echo _ASSET;?>js/kts.en.v1.php?v=<?php echo md5(filemtime(_ASSET.'js/kts.en.v1.php'));?>"></script>     
</body>
</html>