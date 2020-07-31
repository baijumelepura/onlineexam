
 <div class="container">


<div class="row">
	<div class="col-md-12">
	<div class="card">
	  <h5 class="card-header"><?php echo $title;?></h5>
	  <div class="card-body">
	  	   <form method="post" style="width: 100%" action="<?php echo site_url('user/update_user/'.$uid);?>">

			<?php 
			if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
			}
			?>	


			<div class="form-group ">	 
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('email_address');?></label> 
					<input type="email" id="inputEmail" name="email" value="<?php echo $result['email'];?>" readonly=readonly class="form-control" placeholder="<?php echo $this->lang->line('email_address');?>" required autofocus>
			</div>
			<div class="form-group">	  
					<label for="inputPassword" class="sr-only"><?php echo $this->lang->line('password');?></label>
					<input type="password" id="inputPassword" name="password"   value=""  class="form-control" placeholder="<?php echo $this->lang->line('password');?>"   >
			 </div>
				<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('first_name');?></label> 
					<input type="text"  name="first_name"  class="form-control"  value="<?php echo $result['first_name'];?>"  placeholder="<?php echo $this->lang->line('first_name');?>"   autofocus>
			</div>
				<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('last_name');?></label> 
					<input type="text"   name="last_name"  class="form-control"  value="<?php echo $result['last_name'];?>"  placeholder="<?php echo $this->lang->line('last_name');?>"   autofocus>
			</div>
			
				<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('contact_no');?></label> 
					<input type="text" name="contact_no"  class="form-control"  value="<?php echo $result['contact_no'];?>"  placeholder="<?php echo $this->lang->line('contact_no');?>"   autofocus>
			</div>
			<?php /*
							<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('skype_id');?></label> 
					<input type="text" name="skype_id"  class="form-control"  value="<?php echo $result['skype_id'];?>"  placeholder="<?php echo $this->lang->line('skype_id');?>"   autofocus>
			</div> */ ?>
			

				 
			<?php 
			foreach($custom_form as $fk => $fval){

			?>
						<div class="form-group">	 
							<label for="inputEmail"  ><?php echo $fval['field_title']; ?></label> 
							<input type="<?php echo $fval['field_type']; ?>" name="custom[<?php echo $fval['field_id']; ?>]"  class="form-control" value="<?php echo $custom_form_user[$fval['field_id']]; ?>"  <?php echo $fval['field_validate']; ?> >
					</div>

			<?php
			}
			?>	
		<button class="btn btn-primary" type="submit"><?php echo $this->lang->line('submit');?></button>
 
      </form>
	  </div>
	</div>
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
