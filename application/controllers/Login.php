<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->database();
	   $this->load->model("user_model");
		$this->load->model("quiz_model");
		$this->load->model("result_model");
		$this->load->model("social_model");

		
		if($this->db->database ==''){
		$this->load->helper('url');
		redirect('install');	
		}
		 
		 if(!$this->session->userdata("language")){
			$this->session->set_userdata("language","english");
		 }
		$this->lang->load('basic',$this->session->userdata("language"));
		
	 }

	public function index()
	{
		
		$this->load->helper('url');
		if($this->session->userdata('logged_in')){
			$logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']=='1'){
				redirect('dashboard');
			}else{
				redirect('quiz');	
			}
			
		}
		
		
		
		$data['title']=$this->lang->line('login');
		$data['recent_quiz']=$this->quiz_model->recent_quiz('5');
		
		 $this->load->view('login',$data);
		 
	}
	
	public function resend()
	{
		
		
		 $this->load->helper('url');
		if($this->input->post('email')){
		$status=$this->user_model->resend($this->input->post('email'));
		$this->session->set_flashdata('message', $status);
		redirect('login/resend');
		}
		
		
		$data['title']=$this->lang->line('resend_link');
		 
		$this->load->view('header',$data);
		$this->load->view('resend',$data);
		$this->load->view('footer',$data);
	}
	
	
 
	
		function addtocart($gid,$gname,$price){
		$this->load->helper('url');
		if($this->session->userdata('cart')){
			$d=$this->session->userdata('cart');
		$d[]=array(
			$gid,$gname,$price
			);		
		}else{
			$d=array();
		$d[]=array(
			$gid,$gname,$price
			);	
		}
		$this->session->set_userdata('cart',$d);
		$this->session->set_flashdata('message', 'Group added into cart');
			redirect('login/registration/');
	}
	
	function clearcart(){
		$this->load->helper('url');
			$this->session->unset_userdata('cart');
			$this->session->set_flashdata('message', 'Cart cleared successfully');
			redirect('login/pre_registration');
	}
	function clearcartval($gid){
		$this->load->helper('url');
		$d=array();
		foreach($this->session->userdata('cart') as $k => $v){
		if($v[0]==$gid){

		}else{
			$d[]=$v;
		}		
		}
			$this->session->set_userdata('cart',$d);
			$this->session->set_flashdata('message', 'Group removed from cart');
			redirect('login/pre_registration');
	}
	
	
	
	
	
		public function pre_registration()
	{
	$this->load->helper('url');
		$data['title']=$this->lang->line('select_package');
		// fetching group list
		$data['group_list']=$this->user_model->group_list();
		$this->load->view('header',$data);
		$this->load->view('pre_register',$data);
		$this->load->view('footer',$data);
	}

	
public function registration($gid='0')
	{
	$this->load->helper('url');
		$data['gid']=$gid;
		$data['title']=$this->lang->line('register_new_account');
		$data['custom_form']=$this->user_model->custom_form('Registration');
		// fetching group list
		$data['quiz']=null;
		$data['group_list']=$this->user_model->group_list();
		$this->load->view('header',$data);
		$this->load->view('register',$data);
		$this->load->view('footer',$data);
	}

    public function test($quiz=""){
		$this->load->helper('url');
		$data['gid']=0;
		$data['quiz']=$quiz;

		if($this->input->post('password')){
			if($this->input->post('password') == $this->config->item('master_password')){
				$this->session->set_userdata("master_password",$this->config->item('master_password'));
			}else{
				$this->session->set_flashdata('message', "<div style='width: 308px;margin-left: 108px;' class='alert alert-danger'>Incorrect password ..! </div>");
				redirect('login/test/'.$quiz);
			}
		}



		$data['title']=$this->lang->line('register_new_account');
		$data['custom_form']=$this->user_model->custom_form('Registration');
		// fetching group list
		$data['group_list']=$this->user_model->group_list();
		$this->load->view('header',$data);
		$this->load->view('register',$data);
		$this->load->view('footer',$data);
	}

	
	
	public function verifylogin($p1='',$p2='',$p3=""){
		$this->load->helper('url');
		if($p1 == ''){
		$username=$this->input->post('email');
		$password=$this->input->post('password');
		}else{
		$username=urldecode($p1);
		$password=urldecode($p2);
		}
		 $status=$this->user_model->login($username,$password);



		if($status['status']=='1'){
			
			// row exist fetch userdata
			$user=$status['user'];
			$gids=$user['gid'];
			$uid=$user['uid'];
			 $sl="select * from savsoft_group where gid in ($gids) ";
			$rq=$this->db->query($sl);
			 
			$gr=$rq->result_array();
			 
			$price=0;
				
				
			foreach($gr as $pk => $pv){
				$gid=$pv['gid'];
				$sl2="select * from savsoft_payment where uid='$uid' and gid='$gid' and payment_status='Paid' ";
				 
				$sl3=$this->db->query($sl2);
				// echo $sl3->num_rows(); echo "<br>";
				
			if($sl3->num_rows() >= 1){
					
				}else{
			$price += $pv['price'];	
				}
			}
		 
			// validate if user assigned to paid group
			if($price > '0'){
				
				// user assigned to paid group now validate expiry date.
				if($user['subscription_expired'] <= time()){
					// eubscription expired, redirect to payment page
					
				//	redirect('payment_gateway_2/subscribe/'.$gids.'/'.$user['uid']);
					
				}
				
			}
			 
			$user['base_url']=base_url();
			// creating login cookie
			$this->session->set_userdata('logged_in', $user);
			// redirect to dashboard
			if($user['su']=='1'){
			 redirect('dashboard');				 
			}else{
                if($p3 || $this->input->get('quiz')){
					$keys = ($p3) ? $p3 : $this->input->get('quiz');
					$quiz_id = array_search($keys,$this->config->item('quiz_list'));
	               $this->session->set_userdata("reg_quiz",$quiz_id);
				   $burl = $this->config->item('base_url').'index.php/quiz/quiz_detail/'.$quiz_id;
				}else{
					$this->session->unset_userdata('reg_quiz');
					$burl = $this->config->item('base_url').'index.php/quiz/';
				} 
			 header("location:$burl");
			}
		}     
   
	
	$this->session->set_flashdata('message', $status['message']);
	$url = "";
	if($this->input->get('quiz')){
		$url = "?quiz=".$this->input->get('quiz');
	}
	 redirect('login'.$url.'');
	}
	
	
	
	
		
	function verify($vcode){
		$this->load->helper('url');	 
		 if($this->user_model->verify_code($vcode)){
			 $data['title']=$this->lang->line('email_verified');
		   $this->load->view('header',$data);
			$this->load->view('verify_code',$data);
		  $this->load->view('footer',$data);

			}else{
			 $data['title']=$this->lang->line('invalid_link');
		   $this->load->view('header',$data);
			$this->load->view('verify_code',$data);
		  $this->load->view('footer',$data);

			}
	}
	
	
	
	
	function forgot(){
	$this->load->helper('url');
			if($this->input->post('email')){
			$user_email=$this->input->post('email');
			 if($this->user_model->reset_password($user_email)){
				$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('password_updated')." </div>");	
			}else{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('email_doesnot_exist')." </div>");		
			}
			$furl ="";
			if($this->input->get('quiz')){
				$furl = '?quiz='.$this->input->get('quiz');
			}
			redirect('login/forgot'.$furl.'');
			}
			
  
			$data['title']=$this->lang->line('forgot_password');
		   $this->load->view('header',$data);
			$this->load->view('forgot_password',$data);
		  $this->load->view('footer',$data);

	
	}
	
	
public function insert_user( $quiz ="")
	{
	
		
		 $this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required');
      //  $this->form_validation->set_rules('password', 'Password', 'required');
               if($this->form_validation->run() == FALSE){
                    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
					if($quiz) redirect('login/test/'.$quiz.'');
					else redirect('login/registration/'); 
                }
                else
                {
					if($this->user_model->insert_user_3()){
						$this->verifylogin($this->input->post('email'),'654321',$quiz);
						exit;
					}
					if($quiz) redirect('login/test/'.$quiz.'');
					else redirect('login/registration/'); 
                }       

	}
	
	
	
	
	function verify_result($rid){
		$this->load->helper('url');
		$this->load->model("result_model");
		
			$data['result']=$this->result_model->get_result($rid);
	if($data['result']['gen_certificate']=='0'){
		exit();
	}
	
	
	$certificate_text=$data['result']['certificate_text'];
	$certificate_text=str_replace('{email}',$data['result']['email'],$certificate_text);
	$certificate_text=str_replace('{first_name}',$data['result']['first_name'],$certificate_text);
	$certificate_text=str_replace('{last_name}',$data['result']['last_name'],$certificate_text);
	$certificate_text=str_replace('{percentage_obtained}',$data['result']['percentage_obtained'],$certificate_text);
	$certificate_text=str_replace('{score_obtained}',$data['result']['score_obtained'],$certificate_text);
	$certificate_text=str_replace('{quiz_name}',$data['result']['quiz_name'],$certificate_text);
	$certificate_text=str_replace('{status}',$data['result']['result_status'],$certificate_text);
	$certificate_text=str_replace('{result_id}',$data['result']['rid'],$certificate_text);
	$certificate_text=str_replace('{generated_date}',date('Y-m-d',$data['result']['end_time']),$certificate_text);
	
	$data['certificate_text']=$certificate_text;
	  $this->load->view('view_certificate_2',$data);
	 

	}
	
	
	
	function authentication ($user, $pass){
                  global $wp, $wp_rewrite, $wp_the_query, $wp_query;

                  if(empty($user) || empty($pass)){
                    return false;
                  }else{
                    require_once($this->config->item('wp-path'));
                    $status = false;
                    $auth = wp_authenticate($user, $pass );
                    if( is_wp_error($auth) ) {      
                      $status = false;
                    } else {
                    
                    // if username already exist in savsoft_users
                    $this->db->where('wp_user',$user);
                    $query=$this->db->get('savsoft_users');
                    if($query->num_rows()==0){
                    $userdata=array(
                    'password'=>md5($pass),
                    'wp_user'=>$user,
                    'su'=>0,
                    'gid'=>$this->config->item('default_group')                  
                    
                    );
                    $this->db->insert('savsoft_users',$userdata);
                    
                    }
                    
                    
                      $status = true;
                    }
                    return $status;
                  } 
        }
        
        
        public function commercial(){
		$this->load->helper('url');
		
       $data['title']=$this->lang->line('files_missing');
		   $this->load->view('header',$data);
			$this->load->view('files_missing',$data);
		  $this->load->view('footer',$data);
        }



		 // super admin code login controller 
	public function superadminlogin(){
	$this->load->helper('url');
			$logged_in=$this->session->userdata('logged_in_super_admin');
			if($logged_in['su']!='3'){
				exit('permission denied');
				
			}
			
		$user=$this->user_model->admin_login();
		$user['base_url']=base_url();
		 $user['super']=3;
		$this->session->set_userdata('logged_in', $user);
		redirect('dashboard');
	}
	function language($lang = null , $controller = null , $seg = null , $seg2 = null){
		$this->load->helper('url');
		$language = "english";
		if($lang == "english") $language = "english";
		if($lang == "arabic") $language = "arabic";
		
		$this->session->set_userdata("language",$language);
		 if($controller == "registration"){ 
			 if($seg){
				redirect('login/test/'.$seg.'');
			 }else{
			 redirect('login/registration');
			 }

		 }else if($controller == "quiz") {
			 redirect('quiz');
		 }else if($controller == "quiz_detail") {
			redirect("quiz/quiz_detail/".$seg."");
	     }else if($controller == "answer") {
			redirect("login/answer/".$seg."/".$seg2."");
	     }else {
			redirect('login');
		} 
	}
	
	function answer($rid,$method =null){
		
		$this->load->helper('url');
		
			
		$data['result']=$this->result_model->get_result($rid);

	//	print_r($data['result']);die;
		 
		$data['attempt']=$this->result_model->no_attempt($data['result']['quid'],$data['result']['uid']);
		$data['title']=$this->lang->line('result_id').' '.$data['result']['rid'];
	
		 $this->load->model("quiz_model");
		$data['saved_answers']=$this->quiz_model->saved_answers($rid);
		$data['questions']=$this->quiz_model->get_questions($data['result']['r_qids']);
		$data['options']=$this->quiz_model->get_options($data['result']['r_qids']);

		
		// top 10 results of selected quiz
	$last_ten_result = $this->result_model->last_ten_result($data['result']['quid']);
	$value=array();
     $value[]=array('Quiz Name','Percentage (%)');
     foreach($last_ten_result as $val){
     $value[]=array($val['email'].' ('.$val['first_name']." ".$val['last_name'].')',intval($val['percentage_obtained']));
     }
     $data['value']=json_encode($value);
	 
	// time spent on individual questions
	$correct_incorrect=explode(',',$data['result']['score_individual']);
	 $qtime[]=array($this->lang->line('question_no'),$this->lang->line('time_in_sec'));
    foreach(explode(",",$data['result']['individual_time']) as $key => $val){
		if($val=='0'){  $val=1; }
		if($correct_incorrect[$key]=="1"){
	    	$qtime[]=array($this->lang->line('q')." ".($key+1).") - ".$this->lang->line('correct')." ",intval($val));
		}else if($correct_incorrect[$key]=='2' ){
		    $qtime[]=array($this->lang->line('q')." ".($key+1).") - ".$this->lang->line('incorrect')."",intval($val));
		}else if($correct_incorrect[$key]=='0' ){
	    	$qtime[]=array($this->lang->line('q')." ".($key+1).") -".$this->lang->line('unattempted')." ",intval($val));
		}else if($correct_incorrect[$key]=='3' ){
	     	$qtime[]=array($this->lang->line('q')." ".($key+1).") - ".$this->lang->line('pending_evaluation')." ",intval($val));
		}
	}
	 $data['qtime']=json_encode($qtime);
	 $data['percentile'] = $this->result_model->get_percentile($data['result']['quid'], $data['result']['uid'], $data['result']['score_obtained']);

	  $uid=$data['result']['uid'];
	  $quid=$data['result']['quid'];
	  
		$this->load->view('open_header',$data);
		$this->load->view('open_view_result',$data);
	//	$this->load->view('view_result_without_login',$data);
		$this->load->view('footer',$data);	
		
		
	}


	
	
}
