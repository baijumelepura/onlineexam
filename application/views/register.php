
<!--Logo Header open-->
<nav class="navbar navbar-light bg-light clearfix cst-nav">
  <a class="navbar-brand" href="<?php echo base_url();?>">
  <img src="<?php echo base_url('images/logo.png');?>" width="250" height="70" class="d-inline-block align-top" alt="">
  	<?php  $this->lang->line('login_tagline');?> 
  </a>
	<form class="form-inline ml-auto">
		<label class="navbar-text" for="cars">Language</label>
		<select class="form-control mr-sm-2"  id="lang_ar">
		  <option value="english" <?php if($this->session->userdata("language") == 'english'){ echo 'selected';}?> >English</option>
		  <option  value="arabic" <?php if($this->session->userdata("language") == 'arabic'){ echo 'selected';}?> >Arabic</option>
		</select>
	</form>

<script>
$('#lang_ar').change(function(){
	window.location.href = "<?=base_url();?>index.php/login/language/"+$(this).val()+'/registration';
});
</script>
</nav>
<!--Logo Header Close-->


<!-- <nav class="navbar navbar-light bg-light">


</nav>

 -->



<div class="container-fluid reg-section">
	<div class="register" id="regeng">  
 	<div class="row">
		   <div class="col-md-4 register-left">
		        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
		        <h3><?php echo $title;?></h3>
		        <p>To Start your online Accessment From Dr.Nadiabuhannad.com</p>
		      <!--   <a class="btn btn-light" target="blank" href="<?php echo site_url('login');?>"><?php echo $this->lang->line('login');?></a> -->
		    </div>

			<div class="col-md-8 register-right">
			   	<form method="post" action="<?php echo site_url('login/insert_user/'.$quiz.'');?>">
			    	<div class="login-panel panel panel-default">
			    	 	<div class="panel-body"> 
			    	 		<?php 
								if($this->session->flashdata('message')){
									echo $this->session->flashdata('message');	
								}
							?>
							  <div class="row register-form">
							  	 <!--  <h3 class="register-heading">Apply as a Employee</h3> -->
								<div class="col-md-10 offset-md-1 col-xs-12">
									<div class="form-group">	 
										<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('email_address');?></label> 
										<input type="email" id="inputEmail" name="email" class="form-control" placeholder="<?php echo $this->lang->line('email_address');?>" required autofocus>
									</div>
									<div class="form-group">	  
										<label for="inputPassword" class="sr-only"><?php echo $this->lang->line('password');?></label>
										<input type="password" id="inputPassword" name="password"  class="form-control" placeholder="<?php echo $this->lang->line('password');?>" required >
							 		</div>
									<div class="form-group">	 
										<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('first_name');?></label> 
										<input type="text"  name="first_name"  class="form-control" placeholder="<?php echo $this->lang->line('first_name');?>"   autofocus>
									</div>
							
									<div class="form-group">	 
										<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('last_name');?></label> 
										<input type="text"   name="last_name"  class="form-control" placeholder="<?php echo $this->lang->line('last_name');?>"   autofocus>
									</div>
									<div class="form-group">	 
										<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('contact_no');?></label> 
										<input type="text" name="contact_no"  class="form-control" placeholder="<?php echo $this->lang->line('contact_no');?>"   autofocus>
									</div>
									<div class="form-group">	 
										<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('age');?></label> 
										<input type="text" name="age"  class="form-control" placeholder="<?php echo $this->lang->line('age');?>"   autofocus>
									</div>
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
							<!--
								<div class="form-group">	 
									<label   ><?php echo $this->lang->line('select_group');?></label> 
									<select class="form-control" name="gid" id="gid"  >
									<?php 
									foreach($group_list as $key => $val){
										?>
								
									<option value="<?php echo $val['gid'];?>" <?php if($val['gid']==$gid){ echo 'selected'; } ?> ><?php echo $val['group_name'];?> (<?php echo $this->lang->line('price_');?>: <?php echo $val['price'];?>)</option>
															<?php 
														}
														?>
														</select>
												</div>
							 -->


							<?php 
							foreach($custom_form as $fk => $fval){
						 
							?>
							<div class="form-group">	 
								<label for="inputEmail"  ><?php echo $fval['field_title']; ?></label> 
								<input type="<?php echo $fval['field_type']; ?>" name="custom[<?php echo $fval['field_id']; ?>]"  class="form-control" value="<?php echo $fval['field_value']; ?>"  <?php echo $fval['field_validate']; ?> >
							</div>
							
							<?php
							}
							?>			 
							<div class="col-md-10 offset-md-1">
		 						<button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>
								<?php if(!$quiz){ ?>
								<a href="<?php echo site_url('login');?>"><?php echo $this->lang->line('login');?></a>
								<?php }else{ ?>
									<a href="<?php echo site_url('login?quiz='.$quiz);?>" ><?php echo $this->lang->line('login');?></a>
								<?php } ?>
							
							</div>
								 <div class="clearfix"></div>
							</div>
			    	 	</div>
			    	 	 <div class="clearfix"></div>
			    	 </div>
			    	 </form>
			    	</div>

		    <div class="clearfix"></div>
  

	</div>
</div>
</div>




<footer class="text-center">
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
</footer>