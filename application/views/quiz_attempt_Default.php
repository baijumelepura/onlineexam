<!-- Template javascript -->
<script src="<?php echo base_url('js/basic.js?q='.time());?>"></script>
 <style>
 td{
		font-size:14px;
		padding:4px;
	}
.row{
margin:0px;
}
.info-box{
	cursor: pointer;
    width: 40px;
    height: 30px;
    border-radius: 5px;
    background-color: #212121;
    color: #ffffff;
    float: left;
    font-size: 15px;
    padding: 2px;
    text-align: center;
    margin: 5px;
    border: 1px solid #fff;
    -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
}
	
</style>
<script type="text/javascript">
// $(document).ready(function () {
//     //Disable cut copy paste
//     $('body').bind('cut copy paste', function (e) {
//         e.preventDefault();
//     });
    
//     //Disable mouse right click
//     $("body").on("contextmenu",function(e){
//         return false;
//     });
// });
</script>

<script>






var Timer;
var TotalSeconds;


function CreateTimer(TimerID, Time) {
Timer = document.getElementById(TimerID);
TotalSeconds = Time;

UpdateTimer()
window.setTimeout("Tick()", 1000);
}

function Tick() {
if (TotalSeconds <= 0) {
alert("Time's up!")
return;
}

TotalSeconds -= 1;
UpdateTimer()
window.setTimeout("Tick()", 1000);
}

function UpdateTimer() {
var Seconds = TotalSeconds;

var Days = Math.floor(Seconds / 86400);
Seconds -= Days * 86400;

var Hours = Math.floor(Seconds / 3600);
Seconds -= Hours * (3600);

var Minutes = Math.floor(Seconds / 60);
Seconds -= Minutes * (60);


var TimeStr = ((Days > 0) ? Days + " days " : "") + LeadingZero(Hours) + ":" + LeadingZero(Minutes) + ":" + LeadingZero(Seconds)


Timer.innerHTML = TimeStr;
}


function LeadingZero(Time) {

return (Time < 10) ? "0" + Time : + Time;

}

//var myCountdown1 = new Countdown({time:<?php echo $seconds;?>, rangeHi:"hour", rangeLo:"second"});
setTimeout(submitform,'<?php echo $seconds * 1000;?>');
function submitform(){
alert('Time Over');
window.location="<?php echo site_url('quiz/submit_quiz/');?>";
}


 

</script>


  <!-- Modal -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" onclick="show_question_popup();" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>
		  <?php echo $this->lang->line('warning_skip_que');?> &nbsp;
		  <span class="skipques"></span>
		  </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info pull-left " onclick="show_question_popup();" data-dismiss="modal" ><span style="font-size: 14px;margin-right:5px;" class="oi oi-arrow-circle-left"></span>Back</button>
        </div>
      </div>
    </div>
  </div>





<div class="test-attempt">



	<div class="quest-header" style="background:#3D4A5D;padding:4px;color:#ffffff;">
		<!-- <div class="save_answer_signal" id="save_answer_signal2"></div>
		
		<div class="save_answer_signal" id="save_answer_signal1"></div> -->

		<div style="float:right;width:150px; margin-right:10px;" >
			<!-- Time left: <span id='timer' >
			<script type="text/javascript">window.onload = CreateTimer("timer", <?php echo $seconds;?>);</script>
			</span> -->
		</div>
		<div class="quest-heading" style="" >
			<h4 ><?php echo $title;?></h4>
		</div>
		<div style="clear:both;"></div>
	</div>
	
	<div style="clear:both;"></div>



   
 
 <div class="row quest-container"  style="margin-top:0px;height: 90%;">
 <div class="col-md-9">
 <!-- Category button -->

 <div class="row" style="margin:2px;" >
	<?php 
	$categories=explode(',',$quiz['categories']);
	$category_range=explode(',',$quiz['category_range']);
	 
	function getfirstqn($cat_keys='0',$category_range){
		if($cat_keys==0){
			return 0;
		}else{
			$r=0;
			for($g=0; $g < $cat_keys; $g++){
			$r+=$category_range[$g];	
			}
			return $r;
		}
		
		
	}


	if(count($categories) > 1 ){
		$jct=0;
		foreach($categories as $cat_key => $category){
	?>
	<a href="javascript:switch_category('cat_<?php echo $cat_key;?>');"   class="btn btn-info"  style="cursor:pointer;margin-left:5px;"><?php echo $category;?></a>
	<input type="hidden" id="cat_<?php echo $cat_key;?>" value="<?php echo getfirstqn($cat_key,$category_range);?>">
	<?php 
	}
	}
	?>
</div> 


<form method="post" action="<?php echo site_url('quiz/submit_quiz/'.$quiz['rid']);?>" id="quiz_form" >
<input type="hidden" name="rid" value="<?php echo $quiz['rid'];?>">
<input type="hidden" name="noq" value="<?php echo $quiz['noq'];?>">
<input type="hidden" name="individual_time"  id="individual_time" value="<?php echo $quiz['individual_time'];?>">
 
<?php 
$abc=array(
'0'=>'A',
'1'=>'B',
'2'=>'C',
'3'=>'D',
'4'=>'E',
'6'=>'F',
'7'=>'G',
'8'=>'H',
'9'=>'I',
'10'=>'J',
'11'=>'K'
);
$checkans[] = 0;
foreach($questions as $qk => $question){
	$checkans[$qk] = false;
?>
 
 <div id="q<?php echo $qk;?>" class="question_div">
		
		<div class="question_container questions-header shadow-sm">
			<div class="media">
				<img src="https://nadiabuhannad.com/wp-content/uploads/2020/07/cropped-logo-square-180x180.png" style="width: 64px;height: 64px;" class="mr-3" alt="...">
				<div class="media-body">
					<?php 
					if(strip_tags($question['paragraph'])!=""){
					// echo $this->lang->line('paragraph')."<br>";
					echo $question['paragraph']."<hr>";
					}
					?>
					<h5 class="mt-0 q-number"><?php echo $this->lang->line('question');?> <?php echo $qk+1;?></h5>
					
						 <div class="q-text">
								 <?php 

								 if($selected_lang == 1){
							        echo str_replace('../../../',base_url(),str_replace('../../../../',base_url(),$question['question1']));
								 }else{
									echo str_replace('../../../',base_url(),str_replace('../../../../',base_url(),$question['question']));
								 }
								 /* 
						// --- if unclosed HTML tags disturbing layout , use following code 		 
						$qu=str_replace('&#34;','',$question['question']);
						$somevar = new DOMDocument();
						$somevar->loadHTML((mb_convert_encoding($qu, 'HTML-ENTITIES', 'UTF-8')) );
						echo $somevar->saveHTML(); 
						*/		 
								 ?>
								
						 </div>


				</div>
			</div>
		 </div>

		<div class="option_container col-md-11 offset-md-1" >
		 <?php 
		 // multiple single choice
		 if($question['question_type']==$this->lang->line('multiple_choice_single_answer')){
	
			 			 			 $save_ans=array();
			 foreach($saved_answers as $svk => $saved_answer){
				 if($question['qid']==$saved_answer['qid']){
					$save_ans[]=$saved_answer['q_option'];
				 }
			 }
		//	 print_r($save_ans);die;
			 
			 ?>
			 <input type="hidden"  name="question_type[]"  id="q_type<?php echo $qk;?>" value="1">
			 <?php
			$i=0;
			foreach($options as $ok => $option){
				if($option['qid']==$question['qid']){
			?>
			 
		<div class="op">		
		<table>
			<tr>
				<td>
				<b><?php 
if (!in_array($quiz["quid"],$this->config->item('remove_option'))) {
	echo $abc[$i].')';
}


				?>	</b>
				</td>

				<td class="input-holder">
					<input type="radio" onClick="javascript:show_next_question();" name="answer[<?php echo $qk;?>][]"  id="answer_value<?php echo $qk.'-'.$i;?>" value="<?php echo $option['oid'];?>"   
					<?php if(in_array($option['oid'],$save_ans)){ echo 'checked'; } ?>  >
				</td>

			 	<td> <?php  echo ($selected_lang == 1) ? $option['q_option1'] : $option['q_option']; ?> </td>


				 <?php 
if(in_array($option['oid'],$save_ans)){
	$checkans[$qk] = true; 

}
				 ?>

			</tr>
		</table>
		</div>
			 <?php 
			 $i+=1;
				}else{
				$i=0;	
					
				}
			}
		 }
			
// multiple_choice_multiple_answer	

		 if($question['question_type']==$this->lang->line('multiple_choice_multiple_answer')){
			 			 $save_ans=array();
			 foreach($saved_answers as $svk => $saved_answer){
				 if($question['qid']==$saved_answer['qid']){
					$save_ans[]=$saved_answer['q_option'];
				 }
			 }
			 
			 ?>
			 <input type="hidden"  name="question_type[]"  id="q_type<?php echo $qk;?>" value="2">
			 <?php
			$i=0;
			foreach($options as $ok => $option){
				if($option['qid']==$question['qid']){
			?>
			 
		<div class="op">
			<table>
				<tr>
					<td>
						<?php echo $abc[$i];?>) 
					</td>
					<td class="input-holder">
					<input type="checkbox"  name="answer[<?php echo $qk;?>][]" id="answer_value<?php echo $qk.'-'.$i;?>"   value="<?php echo $option['oid'];?>"  <?php if(in_array($option['oid'],$save_ans)){ echo 'checked'; } ?> > 
					</td>
					<td>
					<?php echo ($selected_lang == 1) ? $option['q_option1'] : $option['q_option'];?>
					</td>
				</tr>
			</table>
		 </div>
			 
			 
			 <?php 
			 $i+=1;
				}else{
				$i=0;	
					
				}
			}
		 }
			 
	// short answer	

		 if($question['question_type']==$this->lang->line('short_answer')){
			 			 $save_ans="";
			 foreach($saved_answers as $svk => $saved_answer){
				 if($question['qid']==$saved_answer['qid']){
					$save_ans=$saved_answer['q_option'];
				 }
			 }
			 ?>
			 <input type="hidden"  name="question_type[]"  id="q_type<?php echo $qk;?>" value="3" >
			 <?php
			 ?>
			 
		<div class="op"> 
		<?php echo $this->lang->line('answer');?> 
		<input type="text" name="answer[<?php echo $qk;?>][]" value="<?php echo $save_ans;?>" id="answer_value<?php echo $qk;?>"   >  
		</div>
			 
			 
			 <?php 
			 
			 
		 }
		 
		 
		 	// long answer	

		 if($question['question_type']==$this->lang->line('long_answer')){
			 $save_ans="";
			 foreach($saved_answers as $svk => $saved_answer){
				 if($question['qid']==$saved_answer['qid']){
					$save_ans=$saved_answer['q_option'];
				 }
			 }
			 ?>
			 <input type="hidden"  name="question_type[]" id="q_type<?php echo $qk;?>" value="4">
			 <?php
			 ?>
			 
		<div class="op"> 
		<?php echo $this->lang->line('answer');?> <br>
		<?php echo $this->lang->line('word_counts');?> <span id="char_count<?php echo $qk;?>">0</span>
		<textarea name="answer[<?php echo $qk;?>][]" id="answer_value<?php echo $qk;?>" style="width:100%;height:30%;" onKeyup="count_char(this.value,'char_count<?php echo $qk;?>');"><?php echo $save_ans;?></textarea>
		</div>
			 
			 
			 <?php 
			 
			 
		 }
			 
		
		
		
		
		
		
		// matching	

		 if($question['question_type']==$this->lang->line('match_the_column')){
			 			 			 $save_ans=array();
			 foreach($saved_answers as $svk => $saved_answer){
				 if($question['qid']==$saved_answer['qid']){
					// $exp_match=explode('__',$saved_answer['q_option_match']);
					$save_ans[]=$saved_answer['q_option'];
				 }
			 }
			 
			 
			 ?>
			 <input type="hidden" name="question_type[]" id="q_type<?php echo $qk;?>" value="5">
			 <?php
			$i=0;
			$match_1=array();
			$match_2=array();
			foreach($options as $ok => $option){
				if($option['qid']==$question['qid']){
					$match_1[]=$option['q_option'];
					$match_2[]=$option['q_option_match'];
			?>
			 
			 
			 
			 <?php 
			 $i+=1;
				}else{
				$i=0;	
					
				}
			}
			?>
			<div class="op">
						<table>
						
						<?php 
			shuffle($match_1);
			shuffle($match_2);
			foreach($match_1 as $mk1 =>$mval){
						?>
						<tr><td>
						<?php echo $abc[$mk1];?>)  <?php echo $mval;?> 
						</td><td>
						
							<select name="answer[<?php echo $qk;?>][]" id="answer_value<?php echo $qk.'-'.$mk1;?>"  >
							<option value="0"><?php echo $this->lang->line('select');?></option>
							<?php 
							foreach($match_2 as $mk2 =>$mval2){
								?>
								<option value="<?php echo $mval.'___'.$mval2;?>"  <?php $m1=$mval.'___'.$mval2; if(in_array($m1,$save_ans)){ echo 'selected'; } ?> ><?php echo $mval2;?></option>
								<?php 
							}
							?>
							</select>

						</td>
						</tr>
				
						
						<?php 
			}
			
			
			?>
			</table>
			 </div>
			<?php
			
		 }
			
		 ?>

		</div> 
 </div>
 
 
 
 <?php
}
?>
</form>
 </div>


 <!--hint section-->
<div class="col-md-3 ques-hint shadow-sm">
   
	<b> <h5><?php echo $this->lang->line('dash-instruction-questions');?></h5></b>
	<!-- <p style="color:#333131;"><?php echo $this->lang->line('quest-dash-instruction');?></p> -->
	<ul>
		<li style="color:#333131;">
			<?php echo $this->lang->line('quest-dash-instruction-1');?>
		</li>
		<li style="color:#333131;">
			<?php echo $this->lang->line('quest-dash-instruction-2');?>
		</li>
	</ul>
	<div style="max-height:46%;overflow-y:auto;">
		<?php 
			$showhidebutton = true;
		for($j=0; $j < $quiz['noq']; $j++ ){
			if(!$checkans[$j]){ $showhidebutton = false; }
			?>
			
			<div rel="<?php echo $j;?>" style="<?php if($checkans[$j]){echo 'background:#0a9401;';}else{echo 'background:#c9302c;'; }?>"
			 class="qbtn " onClick="javascript:show_question('<?php echo $j;?>');" id="qbtn<?php echo $j;?>"  ><?php echo ($j+1);?></div>
			
			<?php 
		}
		?>
		<div style="clear:both;"></div>
	</div>
<hr>
	<div>
		<table>
			<tr><td style="font-size:12px;"><div class="info-box" style="background:#0a9401;"></div></td><td class="attempt-info"><?php echo $this->lang->line('Answered');?>  </td></tr>
			<tr><td style="font-size:12px;"><div class="info-box" style="background:#c9302c;"></div></td><td class="attempt-info"> <?php echo $this->lang->line('UnAnswered');?>  </td></tr>
			<!-- <tr><td style="font-size:12px;"><div class="qbtn" style="background:#ec971f;"></div></td><td class="attempt-info"> <?php echo $this->lang->line('Review-Later');?>  </td></tr> -->
			<!-- 	 -->
		</table>
		<div style="clear:both;"></div>

	</div>

 </div>
 
 
 </div>
  
 



</div>



<div class="footer_buttons" style="background:#3D4A5D;">
	<?php /* <button class="btn btn-warning"   onClick="javascript:review_later();"  ><?php echo $this->lang->line('review_later');?></button> -->
	
	<button class="btn btn-info"  onClick="javascript:clear_response();"   ><?php echo $this->lang->line('clear');?></button>

	<button class="btn btn-success"  id="backbtn" style="visibility:hidden;" onClick="javascript:show_back_question();"   ><span style="font-size: 14px;margin-right:5px;" class="oi oi-arrow-circle-left"></span><?php echo $this->lang->line('back');?></button> */ ?>
	
	<?php /* <button class="btn btn-success" id="nextbtn" onClick="javascript:show_next_question();" ><?php echo $this->lang->line('save_next');?></button> 
	
	<button class="btn btn-danger btn-save"  
	        style="<?php if(!$showhidebutton){ echo 'display:none;';}?>"
	        onClick="javascript:submit_quiz();"  ><i style="display:none;" class="fa fa-spinner sub-spinner fa-pulse  fa-lg"></i>&nbsp;<?php echo $this->lang->line('submit_quiz');?></button> */ ?>

			<button class="btn btn-danger btn-save"  
	        onClick="javascript:submit_validation();"  >
			<i style="display:none;" class="fa fa-spinner sub-spinner fa-pulse  fa-lg"></i>&nbsp;<?php echo $this->lang->line('submit_quiz');?></button>



</div>

<script>
var ctime=0;
var ind_time=new Array();
<?php 
$ind_time=explode(',',$quiz['individual_time']);
for($ct=0; $ct < $quiz['noq']; $ct++){ ?>
  ind_time[<?php echo $ct;?>]=<?php if(!isset($ind_time[$ct])){ echo 0;}else{ echo $ind_time[$ct]; }?>;
<?php } ?>
noq="<?php echo $quiz['noq'];?>";
show_question('0');


function increasectime(){
	
	ctime+=1;
 
}
 setInterval(increasectime,1000);
 setInterval(setIndividual_time,30000);


</script>
 
 


 
 
<div  id="warning_div" style="padding:10px; position:fixed;z-index:100;display:none;width:100%;border-radius:5px;height:200px; border:1px solid #dddddd;left:4px;top:70px;background:#ffffff;">
<center><b> <?php echo $this->lang->line('really_Want_to_submit');?></b> <br><br>
<span id="processing"></span>

<a href="javascript:cancelmove();"   class="btn btn-danger"  style="cursor:pointer;"><?php echo $this->lang->line('cancel');?></a> &nbsp; &nbsp; &nbsp; &nbsp;
<a href="javascript:submit_quiz();"   class="btn btn-info"  style="cursor:pointer;"><?php echo $this->lang->line('submit_quiz');?></a>
</center>
</div>
