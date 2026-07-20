<?php
/**
 * Calculates the KTS scores, percentages, and personality code.
 *
 * @param array $answers Array of statements answers where key is statement ID (1-70) and value is choice (1-5)
 * @return array Array containing 'scores' ($r), 'percentages' ($persen), and 'code' ($code)
 */
function calculateKts(array $answers) {
    $data = array(
        array('t1'=>'E','t2'=>'I','g'=>array(1,8,15,22,29,36,43,50,57,64)), 
        array('t1'=>'S','t2'=>'N','g'=>array(2,9,16,23,30,37,44,51,58,65,3,10,17,24,31,38,45,52,59,66)),
        array('t1'=>'T','t2'=>'F','g'=>array(3,11,18,25,32,39,46,53,60,67,5,12,19,26,33,40,47,54,61,68)),
        array('t1'=>'J','t2'=>'P','g'=>array(6,13,20,27,34,41,48,55,62,69,7,14,21,28,35,42,49,56,63,70))
    );
    
    $r = array(
        'E' => 0, 'I' => 0,
        'S' => 0, 'N' => 0,
        'T' => 0, 'F' => 0,
        'J' => 0, 'P' => 0
    );
    
    foreach($answers as $k=>$d){
        if(in_array($k,$data[0]['g'])){
            $r[$data[0]['t1']]+=($d==1||$d==3?1:($d==2?0.5:0));
            $r[$data[0]['t2']]+=($d==5||$d==3?1:($d==4?0.5:0));
        }elseif(in_array($k,$data[1]['g'])){
            $r[$data[1]['t1']]+=($d==1||$d==3?1:($d==2?0.5:0));
            $r[$data[1]['t2']]+=($d==5||$d==3?1:($d==4?0.5:0));
        }if(in_array($k,$data[2]['g'])){
            $r[$data[2]['t1']]+=($d==1||$d==3?1:($d==2?0.5:0));
            $r[$data[2]['t2']]+=($d==5||$d==3?1:($d==4?0.5:0));
        }if(in_array($k,$data[3]['g'])){
            $r[$data[3]['t1']]+=($d==1||$d==3?1:($d==2?0.5:0));
            $r[$data[3]['t2']]+=($d==5||$d==3?1:($d==4?0.5:0));
        }
    }
    
    $persen = array();
    foreach($r as $k=>$v){
        $persen[$k] = round(($v/($k=='E'||$k=='I'?10:20)),2)*100;
    }
    
    $code = ($r['E']>$r['I']?'E':'I') . ($r['S']>$r['N']?'S':'N') . ($r['T']>$r['F']?'T':'F') . ($r['J']>$r['P']?'J':'P');
    
    return array(
        'scores' => $r,
        'percentages' => $persen,
        'code' => $code
    );
}
