<?php
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME     : result.php
AUTHOR       : CAHYA DSN
CREATED DATE : 2017-12-12
UPDATED DATE : 2026-07-06 08:55:00
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
session_start();
if(isset($_POST['d'])){
	include 'inc/config.php';
	require_once 'inc/kts_calc.php';
	$ktsResult = calculateKts($_POST['d']);
	$r = $ktsResult['scores'];
	$persen = $ktsResult['percentages'];
	$code = $ktsResult['code'];
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
<!DOCTYPE html>
<html data-theme="<?php echo $c;?>">
  <head>
    <title>KTS®-II Questionnaire</title>
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
    <link rel="stylesheet" href="<?php echo _ASSET;?>css/style.css">
  </head>
  <body>
  <header>
    <a href="index.php" class="brand"># KTS®-II v<?php echo $version;?></a>
    <div class="theme-selector" id="theme">
      <?php
      $colors_list=array("black","brown","pink","orange","amber","lime","green","teal","purple","indigo","blue","cyan");
      foreach($colors_list as $col){
        $active_class = ($col === $c) ? ' active' : '';
        echo "<a href='#' class='theme-pill theme-{$col} color{$active_class}' data-value='{$col}' title='{$col}'></a>";
      }
      ?>	
    </div>
  </header>

  <div class="container">
    <div class="card">
      <h2 class="title">The Keirsey Temperament Sorter®-II (KTS®-II) Result</h2>
      
      <div class="result-box">
        <h3>Temperament : <?php echo $row->temperament;?> (<?php echo $row->code;?>)</h3>
      </div>

      <div class="result-section">
        <h4>Overview</h4>
        <p><?php echo $row->overview;?></p>
      </div>

      <div class="result-section">
        <h4>All <?php echo $row->temperament;?> share the following core characteristics:</h4>
        <ul>
          <li><?php $characters=explode('|',$row->characteristic);echo implode('</li><li>',$characters);?></li>
        </ul>
      </div>

      <div class="result-section">
        <h4>Portrait of the <?php echo $row->temperament;?></h4>
        <p><?php echo implode('</p><p>',explode('|',$row->content));?></p>
      </div>

      <div class="result-box">
        <h3>Personality type : <?php echo $row->short;?> (<?php echo $row->symbol;?>)</h3>
      </div>

      <div class="result-section">
        <p><?php $personality=explode('|',$row->description);echo implode('</p><p>',$personality);?></p>
      </div>

      <div class="result-section">
        <h4>Finding Your Passion or What Makes a Job Right for You?</h4>
        <p><b><?php echo $row->temperament.' - '.$row->finding;?></b></p>
        <p><?php echo $row->passion;?></p>
      </div>

      <div class="result-section">
        <h4>Dealing with Stress from Work: <?php echo $row->temperament;?></h4>
        <p>How do you deal with work-related stress? Each personality type has different stressors and copes in different ways. Better understanding of your own stressors and coping mechanisms can help you reduce the tension and anxiety work stress often creates.</p>
        <p><?php echo $row->dealing;?></p>
        <p><?php $stress=explode('|',$row->stress);echo implode('</p><p>',$stress);?></p>
      </div>

      <div class="footer-info">
        <b>Source Code (v0.3)</b> : <a href='https://github.com/cahyadsn/kts-2-questionnarie' target="_blank">https://github.com/cahyadsn/kts-2-questionnarie</a>
      </div>
    </div>
  </div>

  <footer class="page-footer">
    KTS®-II Questionnaire v<?php echo $version;?> copyright &copy; 2017<?php echo (date('Y')>2017?date('-Y'):'');?> by&nbsp;<a href='mailto:cahyadsn@gmail.com'>cahya dsn</a>
  </footer>

  <script src="<?php echo _ASSET;?>js/kts.en.v2.php?v=<?php echo md5(filemtime(_ASSET.'js/kts.en.v2.php'));?>"></script>     
</body>
</html>