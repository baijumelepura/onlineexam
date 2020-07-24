 <script src="<?php echo base_url('js/TweenMax.min.js');?>"></script>
 <style>
@media print {
   
   .navbar{
   display:none;
   }
   #footer{
   display:none;
   } 
   .printbtn{
	  display:none; 
   }
   #social_share{
	   display:none;
   }
   
   #page_break2{
	   
   page-break-after: always;
	}
	
	.noprint{
		
		display:none; 
	}
}
@media screen {
	.onlyprint{
		display:none; 
		
	}
}
table.client-details tr td{
	padding: 5px;
}
 td{
		color:#212121;
		font-size:14px;
		padding:4px;
	}
	.circle_result{
		width: 40px;
	    height: 40px;
	    border-radius: 20px;
	    background: #0b8d6f;
	    color: #ffffff;
	    padding: 5px;
	    font-size: 16px;
	    text-align: center;
		margin-right:20px;
		float:left;
	}


.circle_ur{
	
	width: 40px;
    height: 40px;
    border-radius: 20px;
    background: #ffcc66;
    color: #ffffff;
    padding: 5px;
    font-size: 16px;
    text-align: center;
	margin-right:20px;
	float:left;
}


.circle_l{
	
	width: 40px;
    height: 40px;
    border-radius: 20px;
    background: #ff3300;
    color: #ffffff;
    padding: 5px;
    font-size: 16px;
    text-align: center;
	margin-right:20px;
	float:right;
}

.td_line{
	background:url('<?php echo base_url('images/rankbar.png');?>');background-repeat: repeat-x;
}
.print-area table.client-details tr td{
    font-size: 16px;
}
.print-area table.client-details tr td:first-child{
    font-weight: bold;
}
</style>
 <div class="container">
<?php 
$logged_in=$this->session->userdata('logged_in');
?>
   
<?php 

function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $ends[$number % 10];
}

function questioninwhichcategory($key,$c_range){
	foreach($c_range as $k => $cv){
		
		if($key >= $cv[0] && $key <= $cv[1]){
			return $k;
		}
	}
	
}




function cia_cat($narray,$c_range){
	$unattempted=array();
	$correct=array();
	$incorrect=array();
	foreach($narray as $k => $val){
		
	if($val==0){
		if(isset($unattempted[questioninwhichcategory($k,$c_range)])){
		$unattempted[questioninwhichcategory($k,$c_range)]+=1;
		}else{
		$unattempted[questioninwhichcategory($k,$c_range)]=1;	
		}
	}else if($val==1){
// $correct+=1;
		if(isset($correct[questioninwhichcategory($k,$c_range)])){
		$correct[questioninwhichcategory($k,$c_range)]+=1;
		}else{
		$correct[questioninwhichcategory($k,$c_range)]=1;	
		}
	}else if($val==2){
// $incorrect+=1;
		if(isset($incorrect[questioninwhichcategory($k,$c_range)])){
		$incorrect[questioninwhichcategory($k,$c_range)]+=1;
		}else{
		$incorrect[questioninwhichcategory($k,$c_range)]=1;	
		}
	}	
	 
		 
	 
	}
	
	return array($correct,$incorrect,$unattempted);
}





function cia_tim_cate($narray,$tim,$c_range){
	$unattempted=array();
	$correct=array();
	$incorrect=array();
	foreach($narray as $k => $val){
	
	if($val==0){
		if(isset($unattempted[questioninwhichcategory($k,$c_range)])){
		$unattempted[questioninwhichcategory($k,$c_range)]+=$tim[$k];
		}else{
		$unattempted[questioninwhichcategory($k,$c_range)]=$tim[$k];	
		}
	}else if($val==1){
// $correct+=1;
		if(isset($correct[questioninwhichcategory($k,$c_range)])){
		$correct[questioninwhichcategory($k,$c_range)]+=$tim[$k];
		}else{
		$correct[questioninwhichcategory($k,$c_range)]=$tim[$k];	
		}
	}else if($val==2){
// $incorrect+=1;
		if(isset($incorrect[questioninwhichcategory($k,$c_range)])){
		$incorrect[questioninwhichcategory($k,$c_range)]+=$tim[$k];
		}else{
		$incorrect[questioninwhichcategory($k,$c_range)]=$tim[$k];	
		}
	}	
	
	}
		
	return array($correct,$incorrect,$unattempted);
}

function prezero($val){
	if($val <= 9){
	return '0'.$val;	
	}else{
		return $val;
	}
}
function secintomin($sec){
	if($sec >= 60){
	$splitin=explode('.',($sec/60));
	if(isset($splitin[1])){
		$secs=substr(intval((substr($splitin[1],0,2)*60)/100),0,2);
	}else{
		$secs=0;
	}
	return $splitin[0].':'.prezero($secs);
	}else{
	return '0:'.prezero($sec);	
	}
}


function per_nonzero($arr){
	
$totallen=count($arr);
$filt=array_filter($arr);
$per=(count($filt)/$totallen)*100;
return intval($per);	
}

$c_range=array();
$j=0;
$i=0;
foreach(explode(",",$result['category_range']) as $ck => $cv){
	$c_range[]=array($i,($i+($cv-1)));
	$i+=$cv;
}
$correct_incorrect_unattempted=explode(",",$result['score_individual']);
 
$cia_cat=cia_cat($correct_incorrect_unattempted,$c_range);
 
$cia_tim_cate=cia_tim_cate($correct_incorrect_unattempted,explode(",",$result['individual_time']),$c_range);
?>
<?php 
$noq=count($result['r_qids']);
$category_range=explode(',',$result['category_range']);
$category_ranges=array();
$qi=0;
foreach($category_range as $qik => $qvv){
 $category_ranges_i=array($qi,($qi+($qvv-1)));
 $category_ranges[]=$category_ranges_i;
$qi+=$qvv;
}
 
?>

  <div class="row">
 

<div class="col-md-12 print-area">

 <div class="login-panel panel panel-default">
 	<div class="card" style="">
 		  <div class="card-header">
		    <h3 style="float:left">Client Details</h3>
		     <a href="javascript:print();" class="btn btn-success printbtn" style="float:right;"><?php echo $this->lang->line('print');?></a>
		  </div>

			<div class="panel-body card-body"> 
				<table class="table table-bordered client-details">
				
					<tr><td><?php echo $this->lang->line('name');?></td><td><?php echo $result['first_name'];?> <?php echo $result['last_name'];?></td></tr>
					<tr><td><?php echo $this->lang->line('email');?></td><td><?php echo $result['email'];?></td></tr>
					<tr><td><?php echo $this->lang->line('contact_no');?></td><td><?php echo $result['contact_no'];?></td></tr>
					<tr><td><?php echo $this->lang->line('age');?></td><td><?php echo $result['age'];?></td></tr>
					<tr><td><?php echo $this->lang->line('quiz_name');?></td><td><?php echo $result['quiz_name'];?></td></tr>
					<tr><td><?php echo $this->lang->line('attempt_time');?></td><td><?php echo date('d-m-Y',$result['start_time']);?></td></tr>
					<?php /*<tr><td><?php echo $this->lang->line('time_spent');?></td><td><?php echo secintomin($result['total_time']);?></td></tr>
					<<tr><td><?php echo $this->lang->line('percentage_obtained');?></td><td><?php echo $result['percentage_obtained'];?>%</td></tr>
					<tr><td><?php echo $this->lang->line('percentile_obtained');?></td><td><?php echo substr(((($percentile[1]+1)/$percentile[0])*100),0,5);   ?>%</td></tr> <?php */?>
					<!-- <tr><td><?php echo $this->lang->line('score_obtained');?></td><td><?php echo $result['score_obtained'];?> / <?=count($questions);?></td></tr> -->
					<?php /*<tr><td><?php echo $this->lang->line('status');?></td><td><?php echo $result['result_status'];?></td></tr> <?php */?>

				</table>
			</div>

	</div>
</div>


<?php
$ind_score=explode(',',$result['score_individual']); 
// view answer
if(1==1){
?>
<div class="login-panel panel panel-default ">
	<div class="panel-body card"> 
		<a name="answers_i"></a>
		<div class="card-header"><h3><?php echo $result['quiz_name'];?> - <?php echo $this->lang->line('answer_sheet');?> </h3></div>
		<div class="card-body">
			<div class="rqn ques-ans" id="qn<?php echo $qk;?>" >
				<table class="table table-striped"  >
				  <thead>
				    <tr>
				      <th scope="col">Q-No</th>
				      <th scope="col">Question</th>
				      <th scope="col">Correct Answer</th>
				      <th scope="col">Client Answer</th>
				    </tr>
				  </thead>
				  <tbody>
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
$seg3=$this->uri->segment(4);
 
if($seg3==''){
$seg3=0;
}





foreach($questions as $qk => $question){
// remove below condition for all solution at one page

?>


<!--question and answer for print-->

    <tr id="q<?php echo $qk;?>">
      <th scope="row"><?php echo $qk+1;?></th>

      <td>
      	      		<?php
		if(strip_tags($question['paragraph'])!=""){
		 echo $this->lang->line('paragraph')."<br>";
		 echo $question['paragraph']."<hr>";
		}

		if($this->session->userdata("language")== "english"){
		 echo str_replace('../../../',base_url(),str_replace('../../../../',base_url(),$question['question1']));
		 }else{
			echo str_replace('../../../',base_url(),str_replace('../../../../',base_url(),$question['question1']));

		 }?>

      </td>
       		 <?php

		 //############################################ multiple single choice
		 if($question['question_type']==$this->lang->line('multiple_choice_single_answer')){
			 
			 			 			 $save_ans=array();
			 foreach($saved_answers as $svk => $saved_answer){
				 if($question['qid']==$saved_answer['qid']){
					$save_ans[]=$saved_answer['q_option'];
				 }
			 }
			 
			 ?>
 			<input type="hidden"  name="question_type[]"  id="q_type<?php echo $qk;?>" value="1">
 						 <?php
			$i=0;
			$correct_options=array();
			foreach($options as $ok => $option){
				if($option['qid']==$question['qid']){
					if($option['score'] >= 0.1){
						$correct_options[]=$option['q_option'];
					}
			?>
		 <?php if(in_array($option['oid'],$save_ans)){   echo'<td>'.$this->lang->line.$option['q_option'].'</td>'; } ?>
		 	 <?php 
			 $i+=1;
				}else{
				$i=0;	
					
				}
			};
			echo "<td>".$this->lang->line.implode(', ',array_map('trim',($correct_options))).'</td>';
		 }
		 //################################ multiple_choice_multiple_answer	

		 if($question['question_type']==$this->lang->line('multiple_choice_multiple_answer')){
			 			 $save_ans=array();
			 foreach($saved_answers as $svk => $saved_answer){
				 if($question['qid']==$saved_answer['qid']){
					$save_ans[]=$saved_answer['q_option'];
				 }
			 }
			 
			 ?>
			  <input type="hidden"  name="question_type[]"  id="q_type<?php echo $qk;?>" value="2">
			  <?php echo '<td>'.$this->lang->line('your_answer').'</td>:';
			$i=0;
			$correct_options=array();
			foreach($options as $ok => $option){
				if($option['qid']==$question['qid']){
						if($option['score'] >= 0.1){
						$correct_options[]=$option['q_option'];
					}
			?>
			<?php 

			if(in_array($option['oid'],$save_ans)){   echo  trim($option['q_option']).', '; }?> 

			 <?php 
			 $i+=1;
				}else{
				$i=0;	
					
				}
			};
			echo "<td>".$this->lang->line('correct_options').'</td>: '.implode(', ',$correct_options);
		 }


		 	//######################### short answer	

		 if($question['question_type']==$this->lang->line('short_answer')){
			 			 $save_ans="";
			 foreach($saved_answers as $svk => $saved_answer){
				 if($question['qid']==$saved_answer['qid']){
					$save_ans=$saved_answer['q_option'];
				 }
			 }
			 ?>
			 <input type="hidden"  name="question_type[]"  id="q_type<?php echo $qk;?>" value="3"   >
			 
			 <?php

			 
			
			 ?>
			 
		<div class="op"> 
		<?php echo '<td>'.$this->lang->line('your_answer').'</td>:';?> 
		   <?php echo $save_ans;?>   
		</div>
			 
			 
			 <?php 
			 			 foreach($options as $ok => $option){
				if($option['qid']==$question['qid']){
					 echo "<td>".$this->lang->line('correct_answer').'</td>: '.$option['q_option'];
			 }
			 }
			 
		 }

	//####################### long answer	

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
		<?php echo $this->lang->line('word_counts');?>  <?php echo str_word_count($save_ans);?>
		<textarea name="answer[<?php echo $qk;?>][]" id="answer_value<?php echo $qk;?>" style="width:100%;height:100%;" onKeyup="count_char(this.value,'char_count<?php echo $qk;?>');"><?php echo $save_ans;?></textarea>
		</div>
				
			 
			 <?php 
			 
			 
		 }


//################################################# matching	

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
						<tr><td></td><td><?php echo "<b>".$this->lang->line('your_answer').'</b> ';?></td><td><?php echo "<b>".$this->lang->line('correct_answer').'</b> ';?></td></tr>
						<?php 
			 
			foreach($match_1 as $mk1 =>$mval){
						?>
						<tr><td>
						<?php echo $abc[$mk1];?>)  <?php echo $mval;?> 
						</td>
						<td>
						
							 
							 <?php 
							foreach($match_2 as $mk2 =>$mval2){
								?>
                              <?php $m1=$mval.'___'.$mval2; if(in_array($m1,$save_ans)){ echo $mval2; } ?>  
								<?php 
							}
							?>
							 

						</td>
						
						<td>
						<?php 
							echo $match_2[$mk1];
							?>
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
      		

   <?php
 
}

}
// view answer ends
?>

    </tr>
    
  </tbody>
</table>





 <div id="page_break"></div>
 
 </div>






 
 </div>
 
 
</div>
      
</div>

 



</div>

<input type="hidden" id="evaluate_warning" value="<?php echo $this->lang->line('evaluate_warning');?>">
 
 <script>
 $('.s_title').tooltip('show');
 </script>


 <script>
 function shoq(id){
	 if(id=="-1"){
		 var did=".rqn";
		 $(did).css('display','block'); 		 
	 }else{
		 var did=".rqn";
		 $(did).css('display','block');
		 var didd="#qn"+id;
		 $(didd).css('display','block');
	 }
 }
 </script>
 
<!-- disable copy, right click -->
<script type="text/javascript">
$(document).ready(function () {
    //Disable cut copy paste
    $('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });
   
    //Disable mouse right click
    $("body").on("contextmenu",function(e){
        return false;
    });
});
</script>
<!-- disable copy, right click ends -->



<!--####################################################################-->
<!--Essay Type -->
<!-- <div class="rqn ques-ans" id="qn<?php echo $qk;?>" >
		<h3>Example- Essay Type  Question</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Q-No</th>
      <th scope="col">Question</th>
      <th scope="col">Client Answer</th>
  
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
     
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
    
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
   
    </tr>
  </tbody>
</table>
</div>
 --><!--Essay Type -->
<!--####################################################################-->
