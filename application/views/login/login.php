<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    if (isset($this->session->userdata['logged_in'])) {
        header("location: Home/dashboard"); 
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Atlas Copco</title>
        <link rel="icon" href="<?=base_url()?>/assests/img/logo.png" type="image/png">
        <script src="<?=base_url()?>/assests/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assests/js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <link href="<?=base_url()?>/assests/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>/assests/css/component.css" rel="stylesheet" type="text/css"/>
        
        <script src="<?=base_url()?>assests/js/forgot_pass.js" type="text/javascript"></script>
          <style type="text/css">

            .modal.show  {
              display:flex!important;
              flex-direction:column;
              justify-content:center;
              align-content:center;
              align-items: flex-start;            
            }
            .container {          
                height: 100%;               
                display: initial;
                justify-content: center;
                align-items: center;
                align-content: center;           

            }
            body{
                justify-content: center;
                align-items: center;
                align-content: center;   
                background: url(assests/img/AtlasCopco.jpg);
            }           
            #forgots{
                display: none;
            }
      </style>  
      
    </head>
    <body style="background-image: url(assests/img/AtlasCopco.jpg);width: 100%;">
       
        <div class="container">        
        
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="text-center" style="font-family:freestyle Script; font-size: 100; src: url(sansation_light.woff); color: white">
               
                    
                 <h1 class="modal-title w-100 font-italic" style="font-size: 75px">WELCOME</h1>
                
             </div>
             <br>
             <br>
             <div class="modal-content" style="background-color: #afd9ee" id="loginPage">
               <div class="modal-header text-center">                 
                  <h2 class="modal-title w-100 font-weight-bold">Login</h2>   
                  <div class="modal-body">                     
                      <form role="form" method="post" action="<?= base_url()?>myLogin">
                         <?php
                                if(isset($message)){
                                   echo "<script type='text/javascript'>alert('$message');</script>";          
                                }
                            ?>
                          <?php
                            
                              if (isset($logout_message)) {                         
                                  echo "<script type='text/javascript'>alert('$logout_message');</script>";                          
                              }
                            ?>
                            <?php
                                 if (isset($message_display)) {                            
                                     echo "<script type='text/javascript'>alert('$message_display');</script>";                            
                                 }
                             ?>                              
                            <?php
                  
                                if (isset($error_message)) {
                                    echo "<script type='text/javascript'>alert('$error_message');</script>";   
                                    echo form_open('loginss');
                                }
                            ?>
                            <div class="modal-body mx-3">
                                <div class="md-form mb-3">
                                     <i class="fas fa-envelope prefix grey-text"></i>
                                    <div class="form-group">                                
                                        <input type="text" name="username" id="user_nmae" class="form-control validate" autofocus required placeholder="Enter Username"/>
                                    </div>                            
                                </div>
                                <div class="md-form mb-3">
                                     <i class="fas fa-envelope prefix grey-text"></i>
                                    <div class="form-group">                                
                                        <input type="password" name="password" id="pass_word" class="form-control validate" placeholder="Enter Password"/>
                                    </div>                           
                                </div>
                                <div class="md-form mb-3">
                                    <i class="fas fa-envelope prefix grey-text"></i>
                                    <div class="form-group">     
                                        <div class="pull-left hidden">
                                            <u class="text-left"><p >New&nbsp;<a href="<?= base_url()?>newUsers" id="regs">Register Now</a></p></u> 
                                        </div>
                                        <div class="pull-right">
                                            <u class="text-right">Forgot&nbsp;<a href="#" id="for_pass">Password</a></u>
                                        </div>
                                         <div class="clearfix"></div>
                                    </div>   
                                </div>
                                <div class="d-flex justify-content-center">
                                  <button type="submit" class="btn btn-hover btn-primary" name="submit">
                                      Login
                                  </button>
                               </div> 
                            </div>                      
                       </form>
                  </div>                   
                </div>
                  
              </div>
             <!--Forgot password-->
             <div class="modal-content" id ="forgots" style="background-color: #afd9ee">
               <div class="modal-header text-center">                  
                  <h2 class="modal-title w-100 font-weight-bold">Forgot Password</h2>    
                  <div class="modal-body">
                      <form role="form" method="post" action="<?= base_url()?>forgotPass">
                            <?php
                                if(isset($message)){
                                   echo "<script type='text/javascript'>alert('$message');</script>";          
                                }
                            ?>
                            <div class="modal-body mx-3">
                                <div class="md-form mb-3">
                                     <i class="fas fa-envelope prefix grey-text"></i>
                                    <div class="form-group">                                
                                        <input type="email" name="email" id="user_nmae1" class="form-control validate" onfocus="this.value=''" placeholder="Enter your Email ID" autofocus required/>
                                    </div>                            
                                </div> 
                                <div class="md-form mb-3">
                                    <i class="fas fa-envelope prefix grey-text"></i>
                                    <div class="form-group text-right">                                 
                                        <u><p>Login&nbsp;<a href="#" id="login_hear">Now</a></p></u>
                                    </div>                           
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-hover btn-primary" name="submit" id="gotoLogin22">
                                        Submit
                                    </button>
                                </div> 
                            </div>     
                        </form>
                  </div> 
                
                </div>
                  
              </div>
             
         </div>	
        </div>
    </body> 
<!--    <script type="text/javascript">
        $(document).on("click","#gotoLogin22",function (){
            var email = $('#user_nmae1').val();

            if(empty(email){
                alert('Please your enter email id')               
            }else{
                alert(email); 
                window.location.href = "https://stackoverflow.com/questions/43080076/how-to-call-controller-function-from-javascript";
            }
            if(validateEmail(email)){
                alert('Valid Email Address');                
            }else{
                alert(email); 
                window.location.href = "https://stackoverflow.com/questions/43080076/how-to-call-controller-function-from-javascript";
                
            }    

        });
    </script>    -->
</html>

