<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>ATLAS COPCO</title>		
		<link rel="shortcut icon" href="<?=base_url()?>/assests/img/logo.png" type="image/png">
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assests/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assests/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assests/css/component.css" />	
                <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
                <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
                <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
                
                <script type="text/javascript">
                $(function() {
                        setTimeout(function() {
                                $('#showMenu').show();
                                $.ajax({
                                    type: 'POST',
                                    url: "<?php echo base_url().'tempTableInsert';?>",
                                    dataType: 'json',
                                    async: false,
                                    success: function (myData1) {
                                       alert(myData1);   
                                    },
                                    error: function (errorThrown) {
                                        alert(errorThrown);
                                        alert("There is an error with AJAX!");     
                                   }
                                });
                        }, 3000);
                    });
                </script>
	</head>
	<body>
            
            
		<div id="perspective" class="perspective effect-rotatetop">
			<div class="container">
				<div class="wrapper"><!-- wrapper needed for scroll -->
					<!-- Top Navigation -->
                                        <div class="codrops-top clearfix">
<!--						<a class="codrops-icon codrops-icon-prev" href="http://tympanus.net/Development/ProgressButtonStyles/"><span>Previous Demo</span></a>
						<span class="right"><a class="codrops-icon codrops-icon-drop" href="http://tympanus.net/codrops/?p=17915"><span>Back to the Codrops Article</span></a></span>-->
					</div>
                                        <header class="codrops-header">
                                            <h1>                                               
                                                UGC Supply Chain Solutions Pvt Ltd
                                                <span>Alandi Fata, Kurali, Maharashtra 410501</span>
                                            </h1>	
                                            
					</header>
					<div class="main clearfix">
						<div class="column">                                                   
                                                    <p><a href="<?= site_url();?>atlas_login" id="showMenu" style="display:none;">Go to Home</a></p>
						    <p>Click on this button to see the content being pushed away in 3D to reveal a navigation or other items.</p>
                                                       
						</div><!--  -->
					</div><!-- /main -->
				</div><!-- wrapper -->
			</div><!-- /container -->
                        
		</div><!-- /perspective -->
		
	</body>   
      
</html>
