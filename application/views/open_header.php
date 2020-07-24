<html lang="en">
   <head>
      <title> <?php echo $title;?></title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- Custom fonts for this template-->
      <link rel="icon" href="http://nadiabuhannad.com/wp-content/uploads/2020/07/cropped-logo-square-32x32.png" sizes="32x32">
      <link href="<?php echo base_url();?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <!-- custom css -->
      <link href="<?php echo base_url('css/style.css?q='.time());?>" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="<?php echo base_url();?>css/sb-admin-2.min.css" rel="stylesheet">
      <style>
         html,body,h1,h2,h3,h4,p,div,span,ul,li,a{
         direction: <?php echo $this->config->item('direction');?>;
         }
         .btn-default{
         border:1px solid #c8c4c4;
         }
         form{
    /*     width: 100%;*/
         }
         .sidebar {
         width: 16rem!important;
         }
         .ques-ans{

         }
      </style>
      <script src="<?php echo base_url();?>vendor/jquery/jquery.min.js"></script>
      <script src="<?php echo base_url();?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="<?php echo base_url();?>vendor/jquery-easing/jquery.easing.min.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="<?php echo base_url();?>js/sb-admin-2.min.js"></script>
      <!-- Page level plugins -->
      <script src="<?php echo base_url();?>vendor/chart.js/Chart.min.js"></script>
      <script>
         var base_url="<?php echo base_url();?>";
         
      </script>
      <?php
         if(($this->uri->segment(1).'/'.$this->uri->segment(2))!='quiz/attempt'){
         ?>
      <!-- custom javascript -->
      <script src="<?php echo base_url('js/basic.js?q='.time());?>"></script>
      <?php
         }
         ?>	
      <!-- firebase messaging menifest.json -->
      <link rel="manifest" href="<?php echo base_url('js/manifest.json');?>">
   </head>

   <!--body-->
   <body id="page-top">

      <!-- Page Wrapper -->
      <div id="wrapper" style="height: 100%;">


      <div id="content-wrapper" class="d-flex flex-column" style="background-color: #dadee8;">
      <!-- Main Content -->
      <div class="content clearfix">


         <!-- Topbar -->
         <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <!-- <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
               <i class="fa fa-bars"></i>
               </button> -->
           
               <a class="navbar-brand" href="<?php echo base_url();?>">
                  <img src="<?php echo base_url('images/logo.png');?>" width="220" height="60" alt="drnadiabuhannad.com">
               </a>
           <!-- <a  href="<?php echo base_url();?>"><img src="<?php echo base_url('images/logo.png');?>"></a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>



         

       
       
   
         <ul class="navbar-nav ml-auto cst-nav">
            <!--Language Selector-->
           
           
       
            <li class="form-inline ml-auto">
               <label class="navbar-text" for="cars">Language</label>
               <select class="form-control mr-sm-2"  id="lang_ar">
                 <option value="english" <?php if($this->session->userdata("language") == 'english'){ echo 'selected';}?> >English</option>
                 <option  value="arabic" <?php if($this->session->userdata("language") == 'arabic'){ echo 'selected';}?> >Arabic</option>
               </select>
            </li>
                     <?php
         $method = $this->router->fetch_method();
         $methods = "answer/".$this->uri->segment(3)."/".$this->uri->segment(4);
         ?>
         <script>
         $('#lang_ar').change(function(){
            window.location.href = "<?=base_url();?>index.php/login/language/"+$(this).val()+'/<?=$methods;?>';
         });
         </script>

          
 
      
         </ul>
           <div class="clearfix"></div>
               </div>
         </nav>
      <div class="clearfix"></div>
      <div class="container-fluid">

      </div>