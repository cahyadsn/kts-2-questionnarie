<?php 
header("Content-type: text/javascript");
?>
$('.w3-radio').on('click',function(){
	$(this).parent().prev().removeClass('incomplete');
	$(this).parent().parent().prev().children().removeClass('incomplete');
});
$('#btn_back').on('click',function(e){
	e.preventDefault();
	$('tbody[id^="p"]').hide();
	var h=$('input#page').val()*1-1;
	$('input#page').val(h);
	$('tbody[id="p'+h+'"]').show();
	if(h==0){
		$(this).addClass('w3-disabled').prop("disabled", true); 
	}
	if( h < 9 ){
		$('#btn_next').removeClass('w3-disabled').prop("disabled", false); 
		$('#btn_kirim').addClass('w3-disabled').prop("disabled", true);
	}
});
$('#btn_next').on('click',function(e){
	e.preventDefault();
	$('tbody[id^="p"]').hide();
	var p=$('input#page').val()*1+1;
	$('input#page').val(p);
	$('tbody[id="p'+p+'"]').show();
	if(p>=0){
		$('#btn_back').removeClass('w3-disabled').prop("disabled", false); 
	}
	if( p == 9 ){
		$(this).addClass('w3-disabled').prop("disabled", true);; 
		$('#btn_kirim').removeClass('w3-disabled').prop("disabled", false);
	}
});
$('a.color').click(function(){
  var color=$(this).attr('data-value');
  <?php 
	if(defined('_ISONLINE')){ 
		echo " document.getElementById('kts_en_css').href='https://www.w3schools.com/lib/w3-theme-'+color+'.css';";
	}else{ 
		echo "document.getElementById('kts_en_css').href='../assets/css/w3/w3-theme-'+color+'.css';";
	} 
  ?>
  $.post('../assets/js/change.color.php',{'color':color});
});
// Questionnaire Validation
$('form[id="kts"] input[type="submit"]').on('click',function(e){
		var answered = 0;
		// Remove incomplete class from all questions
		$('form[id="kts"] td').removeClass('incomplete');
		// Check does we have 70 questions answered
		for ( i=1; i<71; i++ ) {
			// count answered questions
			if ( $('form[id="kts"] input[type="radio"][name^="d['+i+']"]:checked').length == 1 ) {
				answered++;
			} else {
				$('form[id="kts"] input[type="radio"][name^="d['+i+']"]').each(function(i){
					$(this).parent().prev().addClass('incomplete');
				});
			}
		}
		if ( answered != 70 ) {
			// Prevent form submission
			e.preventDefault();
			// Display message
			$('#msg').html('You have answered '+answered+' out of 70 questions.<br>\nPlease review questionnaire and answer marked questions.');
			$('#warning').show();
		}
});