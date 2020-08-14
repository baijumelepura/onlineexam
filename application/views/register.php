
<!--Logo Header open-->
<style>
.error{
    color: red;
    font-size: 1rem;
    position: relative;
    line-height: 1;
    width: 100%;
}
label.error{
	margin-top: 5px;
	margin-bottom: 0px;
}
</style>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->


<nav class="navbar navbar-light bg-light clearfix cst-nav">
  <span class="navbar-brand">
  <img src="<?php echo base_url('images/logo.png');?>" width="250" height="70" class="d-inline-block align-top" alt="">
  	<?php  $this->lang->line('login_tagline');?> 
  </span>
	<!-- <form class="form-inline ml-auto">
		<label class="navbar-text" for="cars">Language</label>
		<select class="form-control mr-sm-2"  id="lang_ar">
		  <option value="english" <?php if($this->session->userdata("language") == 'english'){ echo 'selected';}?> >English</option>
		  <option  value="arabic" <?php if($this->session->userdata("language") == 'arabic'){ echo 'selected';}?> >Arabic</option>
		</select>
	</form> -->

	

<script>
$('#lang_ar').change(function(){
	window.location.href = "<?=base_url();?>index.php/login/language/"+$(this).val()+'/registration/'+"<?=$quiz;?>";
});
</script>
</nav>
<!--Logo Header Close-->



<!-- <nav class="navbar navbar-light bg-light">


</nav>

 -->

 <div class="container-fluid">
<div class="row justify-content-center">
      <div class="col-md-10">
      	    <div class="card o-hidden border-0 shadow-lg my-5" style="margin-top: 5rem!important;">
          		<div class="card-body p-0">
          			<div class="row">
          				<div class="col-lg-6 d-none d-lg-block  " style="background:url('http://nadiabuhannad.com/wp-content/uploads/2020/07/slider-1.png'); background-position: center;background-size: cover;"></div>
          				 <div class="col-lg-6">
			                <div class="p-5">
			                	<div class="text-center" style="padding:20px;">
									<a class="login-brand" href="<?php echo base_url();?>">
									  <img src="<?php echo base_url('images/logo.png');?>" width="240"  alt="drnadiabuhannad.com">
									</a>
								</div>
							    <?php
								if($this->session->userdata("master_password")){  ?>
									 	<form method="post"  id="commentForm" action="<?php echo site_url('login/insert_user/'.$quiz.'');?>">
									 		  <div class="form-group">
									 		  	<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('email_address');?></label> 
												<input type="email" id="inputEmail" name="email" class="form-control form-control-user" placeholder="<?php echo $this->lang->line('email_address');?> *" required autofocus>
									 		  </div>
											 <div class="form-group">	 
												<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('name');?></label> 
												<input type="text"  name="first_name" minlength="2" class="form-control form-control-user" placeholder="<?php echo $this->lang->line('name');?> *" required  autofocus>
											</div>
							
											<div class="form-group">	 
												<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('gender');?></label> 
												<!-- <input type="text"   name="gender" minlength="2"  class="form-control form-control-user" placeholder="<?php echo $this->lang->line('gender');?> *" required  autofocus>-->
												<select name="gender"  class="form-control form-control-user" required>
														<option value=""><?php echo $this->lang->line('Select_a_gender');?></option>
														<option value="<?php echo $this->lang->line('male');?>"><?php echo $this->lang->line('male');?></option>
														<option value="<?php echo $this->lang->line('female');?>"><?php echo $this->lang->line('female');?></option>
												</select>
											</div>
											<div class="form-group">	 
												<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('age');?> *</label> 
												<input id="datepicker" type="text" name="dob"  class="form-control form-control-user" placeholder="<?php echo $this->lang->line('dob');?> *" required  autofocus>
												
											</div>

						<!-- 					<div class="form-group">
												<label for="inputEmail" class="sr-only">Date picker eg</label> 
												    <input id="datepicker" class="form-control form-control-user" placeholder="<?php echo $this->lang->line('dob');?> *" autofocus />
													   
											</div>	 
 -->



											<div class="form-group">	 
												<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('age');?> *</label> 
												<input type="number" name="age"  class="form-control form-control-user" placeholder="<?php echo $this->lang->line('age');?> *" required  autofocus>
											</div>


											<div class="form-group">	 
												<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('nationality');?></label> 
												<input type="text" name="nationality" class="form-control form-control-user" placeholder="<?php echo $this->lang->line('nationality');?> *" required  autofocus>
											</div>

											<div class="form-group">	 
												<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('contact_no');?></label> 
												<input type="text" name="contact_no" minlength="6" class="form-control form-control-user" placeholder="<?php echo $this->lang->line('contact_no');?> *" required  autofocus>
											</div>

											
					
											<?php 
												if($this->session->userdata('cart')){
												$d=$this->session->userdata('cart');
											foreach($d as $k => $v){
											?>

											<input type="hidden" name="gid[]" value="<?php echo $v[0];?>">

											<?php
											}
												}else{
											?>
											<input type="hidden" name="gid[]" value="<?php echo $this->config->item('default_group');?>">
												<?php		
												}
									
												?>


											<?php 
											foreach($custom_form as $fk => $fval){
						 
											?>
											<div class="form-group">	 
												<label for="inputEmail"  ><?php echo $fval['field_title']; ?></label> 
												<input type="<?php echo $fval['field_type']; ?>" name="custom[<?php echo $fval['field_id']; ?>]"  class="form-control form-control-user" value="<?php echo $fval['field_value']; ?>"  <?php echo $fval['field_validate']; ?> >
											</div>
											
											<?php
											}
											?>



												<button class="btn btn-primary" type="submit"><?php echo $this->lang->line('submit');?></button>
									 	</form>
									 <?php }else{ ?>

									 			<form method="post" id="commentForm" action="<?php echo site_url('login/test/'.$quiz.'');?>">
											 
										
											    	 		<?php 
																if($this->session->flashdata('message')){
																	echo $this->session->flashdata('message');	
																}
															?>
													
																	<div class="form-group row">	 
																		<label for="inputEmail" class="col-sm-4 col-form-label" ><?php echo $this->lang->line('password');?></label> 
																		<div class="col-sm-8">
																			<input type="password" id="inputEmail" name="password" class="form-control" placeholder="<?php echo $this->lang->line('Enter_password');?>" required autofocus>
																		</div>
																	</div>
																	
														
													
														
										 						<button class="btn btn-default btn-primary" type="submit"><?php echo $this->lang->line('submit');?></button>
											    	
											    	 	
											    	 		
											    	 
											  
											
											    </form>
	
									 		<?php } ?>




			                </div>
			            </div>

          			</div>
          		</div>
      		</div>
      </div>

		    <div class="clearfix"></div>
</div>

</div>




<!-- <footer class="container-fluid text-center">
	<div class="row">
	      <div class="col-md-12 text-center" >
	      	2020 © Dr. Nadia Buhannad Development & Guidance - All information on this website is provided "as is" without any representations or warranties, express or implied. Developed By VML
	      </div>
	       <div class="col text-right" >
	       <a href="www.nadiabuhannad.com"><i class="fas fa-globe"></i>www.nadiabuhannad.com</a>
	       </div>
	       <div class="col text-left" >
	       	<i class="fas fa-envelope"></i>info@nadiabuhannad.com
	       </div>
	 </div>
</footer> -->


<script src="http://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script>
$("#commentForm").validate();
</script>
<script>
$('#datepicker').datepicker({
	uiLibrary: 'bootstrap',
	format: 'dd/mm/yyyy',
});
</script>