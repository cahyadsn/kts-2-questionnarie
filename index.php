<?php
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME     : index.php
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
include 'inc/config.php';
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
<html data-theme="<?php echo $c;?>">
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
    <link rel="stylesheet" href="<?php echo _ASSET;?>css/style.css">
  </head>
  <body>
  <header>
    <a href="#" class="brand"># KTS®-II v<?php echo $version;?></a>
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
    <form action='result.php' method='post' id='kts'>
      <input type="hidden" id="page" value="0">
      
      <div class="card">
        <h2 class="title">The Keirsey Temperament Sorter®-II (KTS®-II) Questionnaire</h2>
        
        <div class="intro-text">
          The <b>Keirsey Temperament Sorter®-II (KTS®-II)</b> is the most widely used personality instrument in the world. It is a powerful 70 question personality instrument that helps individuals discover their personality type. The KTS-II is based on <b>Keirsey Temperament Theory™</b>, published in the best selling books, <b><i>Please Understand Me®</i></b> and <b><i>Please Understand Me II</i></b>, by <b>Dr. David Keirsey</b>.
        </div>

        <div class="instruction-box">
          <button type="button" onclick="this.parentElement.style.display='none'" class="close-btn">&times;</button>
          <h3>Instructions</h3>
          <p>It is important that you answer all the questions from the perspective of what feels real for you and not try to give answers that you think would sound like how you should behave in any particular situation. The objective is to understand yourself as you really are – not the way, for example, you must react in your job, or others expect you to behave. Effectiveness as an individual or leader is not based on any particular personality style. It is really about how well you know yourself and others.</p>
          <p>There are five choices for each question, which are numbered 1 to 5 with meaning: (1) Absolutely, (2) Kinda, (3) 50/50, (4) Not Really, and (5) Not at All. There are no right or wrong answers – all of the population agrees with whatever choice you make.</p>
        </div>

        <div class="table-responsive">
          <table class="modern-table">
            <thead>
              <tr>
                <th rowspan='2' class="col-no">No</th>
                <th rowspan='2' class="col-statement">Statements</th>
                <th colspan='5' style="text-align: center;">Options</th>
              </tr>
              <tr>
                <th class="col-option" title='Absolutely'>1</th>
                <th class="col-option" title='Kinda'>2</th>
                <th class="col-option" title='50/50'>3</th>
                <th class="col-option" title='Not Really'>4</th>
                <th class="col-option" title='Not at All'>5</th>
              </tr>
            </thead>
            <tbody id='p0'>
              <?php
              $no=0;
              foreach($data as $d){
                $c_rand=rand()%5;
                echo "
                  <tr style='border-top:solid 1px #e2e8f0;'>
                    <td class='col-no'>".++$no."</td>
                    <td class='col-statement right'>{$d->statement}</td>
                    <td class='col-option incomplete' title='absolutely'>
                      <label class='radio-container'>
                        <input type='radio' name='d[{$d->id}]' value='1' class='radio-input' ".(isset($_GET['auto'])?($c_rand==0?'checked ':''):'')."required />
                        <span class='checkmark'></span>
                      </label>
                    </td>
                    <td class='col-option incomplete' title='Kinda'>
                      <label class='radio-container'>
                        <input type='radio' name='d[{$d->id}]' value='2' class='radio-input' ".(isset($_GET['auto'])?($c_rand==1?'checked ':''):'')."required />
                        <span class='checkmark'></span>
                      </label>
                    </td>
                    <td class='col-option incomplete' title='50/50'>
                      <label class='radio-container'>
                        <input type='radio' name='d[{$d->id}]' value='3' class='radio-input' ".(isset($_GET['auto'])?($c_rand==2?'checked ':''):'')."required />
                        <span class='checkmark'></span>
                      </label>
                    </td>
                    <td class='col-option incomplete' title='Not Really'>
                      <label class='radio-container'>
                        <input type='radio' name='d[{$d->id}]' value='4' class='radio-input' ".(isset($_GET['auto'])?($c_rand==3?'checked ':''):'')."required />
                        <span class='checkmark'></span>
                      </label>
                    </td>
                    <td class='col-option incomplete' title='Not at All'>
                      <label class='radio-container'>
                        <input type='radio' name='d[{$d->id}]' value='5' class='radio-input' ".(isset($_GET['auto'])?($c_rand==4?'checked ':''):'')."required />
                        <span class='checkmark'></span>
                      </label>
                    </td>
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

        <div class="controls">
          <div>
            <button class="btn btn-secondary disabled" id="btn_back" disabled>Prev</button>
            <button class="btn btn-secondary" id="btn_next">Next</button>
          </div>
          <div>
            <input type='submit' value='Process' id='btn_kirim' class='btn btn-primary disabled' disabled/>
          </div>
        </div>


        <div class="footer-info">
          <b>Source Code (v0.3)</b> : <a href='https://github.com/cahyadsn/kts-2-questionnarie' target="_blank">https://github.com/cahyadsn/kts-2-questionnarie</a>
        </div>
      </div>
    </form>
  </div>

  <footer class="page-footer">
    KTS®-II Questionnaire v<?php echo $version;?> copyright &copy; 2017<?php echo (date('Y')>2017?date('-Y'):'');?> by&nbsp;<a href='mailto:cahyadsn@gmail.com'>cahya dsn</a>
  </footer>

  <div id="warning" class="modal">
    <div class="modal-content">
      <header class="modal-header"> 
        <h3>Warning</h3>
        <span data-close="modal" class="close-btn" style="color: white; font-size: 1.5rem;">&times;</span>
      </header>
      <div class="modal-body">
        <p id='msg'></p>
      </div>
      <footer class="modal-footer">
        <button type="button" data-close="modal" class="btn btn-secondary">Close</button>
      </footer>
    </div>
  </div>

  <script src="<?php echo _ASSET;?>js/kts.en.v2.php?v=<?php echo md5(filemtime('assets/js/kts.en.v2.php'));?>"></script>     
</body>
</html>