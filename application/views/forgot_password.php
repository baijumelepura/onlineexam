  

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
 		<a class="navbar-brand" href="<?php echo base_url();?>">
                  <img src="<?php echo base_url('images/logo.png');?>" width="220" height="60" alt="drnadiabuhannad.com">
               </a>
               	<?php 
		$furl = "";
			if($this->input->get('quiz')){
				$furl ="?quiz=".$this->input->get('quiz');
			}
        ?>
</nav>



 <div class="container" >
 	<div class="row align-items-center forget-pass">
 		<div class="col-md-6 offset-md-3 forget-pass-col shadow">
 			<form method="post" class="form-signin" action="<?php echo site_url('login/forgot'.$furl);?>">
				<h2 class="form-signin-heading"><?php echo $this->lang->line('forgot_password');?></h2>
				<?php 
				if($this->session->flashdata('message')){
					?>
					<div class="alert alert-danger">
					<?php echo $this->session->flashdata('message');?>
					</div>
				<?php	
				}
				?>				  
				<div class="form-group">	 
						<label for="inputEmail"  ><?php echo $this->lang->line('email_linked_account');?></label> 
						<input type="email" id="inputEmail" name="email" class="form-control" placeholder="<?php echo $this->lang->line('email_address');?>" required autofocus>
				</div>
			 
				<div class="form-group">	  
						<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $this->lang->line('send_new_password');?></button>
				</div>

					<?php 
					if($this->config->item('user_registration')){
						if($this->input->get('quiz')){ ?>
						<a href="<?php echo site_url('login/test/'.$this->input->get('quiz'));?>"><?php echo $this->lang->line('register_new_account');?></a>
						<?php }else{ ?>
							<a href="<?php echo site_url('login/registration');?>"><?php echo $this->lang->line('register_new_account');?></a>
						<?php } ?>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<?php
					}
					if($this->input->get('quiz')){ ?>
					<a href="<?php echo site_url('login?quiz='.$this->input->get('quiz'));?>"><?php echo $this->lang->line('login');?></a>
					<?php }else{  ?>
						<a href="<?php echo site_url('login');?>"><?php echo $this->lang->line('login');?></a>
					<?php } ?>

			</form>
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