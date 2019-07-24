            <div class="navbar" style="padding-top: 1%;">
                <nav class="navbar justify-content-center" style="background-color: #afd9ee;">
                    <div class="container" style="padding-top:1.5%;">    
                        <footer class="page-footer font-small blue">                         
                            <div class="footer-copyright text-center py-3">© 2019 Copyright:
                                <a href="http://www.ugc.ind.in/home.html"> UGC Supply Chian Solution Pvt. Ltd.</a>&nbsp; <a herf="#" style="align-content: center; padding-top: 15px"><?php  date_default_timezone_set('Asia/Kolkata'); echo date("m/d/Y h:i:s")?></a>         
                            </div>                        
                        </footer>
                    </div>
                </nav>

            </div>
            
        </div><!-- /.container-fluid -->

        <script href="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
        <script href="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script href="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         <script src="<?php echo base_url();?>/assests/js/header.js" type="text/javascript"></script>  
        
         
         
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
      <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> 
    

    </body>
</html>
<script type="text/javascript" language="javascript" >   
 $(document).on('click','.priority',function (){
    var SEQ_NO = $(this).attr("id"); 
    $('#loadingmessage').show();
    $('.tab-content').hide();
    $('.nav').hide();
    $('.container-fluid').hide();
    var PP = prompt("Set Priority");
    if(PP != null){
        $.ajax({
            url:"<?php echo base_url().'set_priority'; ?>",  
            method:"POST",  
            data:{SEQ_NO:SEQ_NO,PP:PP},  
            dataType:"json",
            success:function(data){  
                if(data){                        	
                    $('#loadingmessage').hide();
                    alert(data);
                    window.location.href = "<?php echo base_url().'Alls_Fronens';?>";
                    $('.tab-content').show();
                    $('.nav').show();
                    $('.container-fluid').show();
                }  	
            }            
        });
    }
 });
 $(document).on('click','.scm',function (){
    var SEQ_NO = $(this).attr("id"); 
    $('#loadingmessage').show();
    $('.tab-content').hide();
    $('.nav').hide();
    $('.container-fluid').hide();
    var PP = prompt("Enter SCM Remark");
    if(PP != null){
        $.ajax({
            url:"<?php echo base_url().'SCM'; ?>",  
            method:"POST",  
            data:{SEQ_NO:SEQ_NO,PP:PP},  
            dataType:"json",
            success:function(data){  
                if(data){                        	
                    $('#loadingmessage').hide();
                    alert(data);
                    window.location.href = "<?php echo base_url().'Alls_Fronens';?>";
                    $('.tab-content').show();
                    $('.nav').show();
                    $('.container-fluid').show();
                }  	
            }            
        });
    }
 });
 $(document).on('click','.ibl',function (){
    var SEQ_NO = $(this).attr("id"); 
    $('#loadingmessage').show();
    $('.tab-content').hide();
    $('.nav').hide();
    $('.container-fluid').hide();
    var PP = prompt("Enter IBL Remark");
    if(PP != null){
        $.ajax({
            url:"<?php echo base_url().'IBL'; ?>",  
            method:"POST",  
            data:{SEQ_NO:SEQ_NO,PP:PP},  
            dataType:"json",
            success:function(data){  
                if(data){                        	
                    $('#loadingmessage').hide();
                    alert(data);
                    window.location.href = "<?php echo base_url().'Alls_Fronens';?>";
                    $('.tab-content').show();
                    $('.nav').show();
                    $('.container-fluid').show();
                }  	
            }            
        });
    }
 });
 $(document).on('click','.ibl1',function (){
    var SEQ_NO = $(this).attr("id"); 
    $('#loadingmessage').show();
    $('.tab-content').hide();
    $('.nav').hide();
    $('.container-fluid').hide();
    var PP = prompt("Enter IBL Remark");
    if(PP != null){
        $.ajax({
            url:"<?php echo base_url().'IBL'; ?>",  
            method:"POST",  
            data:{SEQ_NO:SEQ_NO,PP:PP},  
            dataType:"json",
            success:function(data){  
                if(data){                        	
                    $('#loadingmessage').hide();
                    alert(data);
                    window.location.href = "<?php echo base_url().'Alls_Fronens_2';?>";
                    $('.tab-content').show();
                    $('.nav').show();
                    $('.container-fluid').show();
                }  	
            }            
        });
    }
 });
    
$(document).on('click', '.update', function(){
    var SEQ_NO = $(this).attr("id"); 
    //alert("Seqiuence No :"+SEQ_NO);   
    var currentdate = new Date(); 
    var datetime = currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/" 
                + currentdate.getFullYear() + " "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();

    var person = prompt("Enter Plan date", datetime);
    $('#loadingmessage').show();
    $('.tab-content').hide();
    $('.nav').hide();
    $('.container-fluid').hide();
      if (person != null) {
             $.ajax({  
                url:"<?php echo base_url().'add_frozen_flag'; ?>",  
                method:"POST",  
                data:{SEQ_NO:SEQ_NO,person:person},  
                dataType:"json",  
                success:function(msg){  
                    if(msg){                        	
                        $('#loadingmessage').hide();
                        alert(msg);
                        window.location.href = "<?php echo base_url().'Alls_Fronens';?>";
                        $('.tab-content').show();
                        $('.nav').show();
                        $('.container-fluid').show();
                    }  	
                }  
           }) ; 
      }
});
$(document).on('click','.add_art',function (){
 var SEQ_NO = $("#seq_no").val();
 alert(SEQ_NO);
 var currentdate = new Date(); 
    var datetime = currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/" 
                + currentdate.getFullYear() + " "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();

    var person1 = prompt("Enter Plan date", datetime);
    if (person1 != null) {
        $.ajax({  
            url:"<?php echo base_url().'add_frozen_flag1'; ?>",  
            method:"POST",  
            data:{SEQ_NO:SEQ_NO,person:person1},  
            dataType:"json",  
            success:function(data){  
                if(data){                        	
                    alert(data);
                    window.location.href = "<?php echo base_url().'Alls_Fronens';?>";
                }  	
            }  
        }) ; 
    }
});
$(document).on('click', '.pick', function(){
    var SEQ_NO = $(this).attr("id"); 
    //alert("Seqiuence No :"+SEQ_NO);
    $('#loadingmessage').show();
    $('.tab-content').hide();
    $('.nav').hide();
    $('.container-fluid').hide();        
     $.ajax({  
                url:"<?php echo base_url().'pick_frozen'; ?>",  
                method:"POST",  
                data:{SEQ_NO:SEQ_NO},  
                dataType:"json",  
                success:function(data){  
                    if(data){                        	
                        $('#loadingmessage').hide();
                        alert(data);
                        window.location.href = "<?php echo base_url().'Alls_Fronens';?>";
                        $('.tab-content').show();
                        $('.nav').show();
                        $('.container-fluid').show();
                    }                    	           		
                }  
           })  
});
$(document).on('click', '.delete', function(){
    var SEQ_NO = $(this).attr("id"); 
    //alert("Seqiuence No :"+SEQ_NO);
    $('#loadingmessage').show();
    $('.tab-content').hide();
    $('.nav').hide();
    $('.container-fluid').hide();
     $.ajax({  
                url:"<?php echo base_url().'close_frozen'; ?>",  
                method:"POST",  
                data:{SEQ_NO:SEQ_NO},  
                dataType:"json",  
                success:function(data){                    
                    if(data){                        	
                        $('#loadingmessage').hide();
                        alert(data);
                        window.location.href = "<?php echo base_url().'Alls_Fronens';?>";
                        $('.tab-content').show();
                        $('.nav').show();
                        $('.container-fluid').show();
                    } 	
                }  
           })
});
$(document).on('click','.plan_close',function (){
    var SEQ_NO = $(this).attr("id"); 
    //alert("Seqiuence No :"+SEQ_NO);
    $('#loadingmessage').show();
    $('.tab-content').hide();
    $('.nav').hide();
    $('.container-fluid').hide();
    $.ajax({
        url: "<?php echo base_url().'close_plans'; ?>",
        method: "POST",
        data: {SEQ_NO:SEQ_NO},
        dataType:"json",
        success: function (data) {
            if(data){                
                alert(data);
                $('#loadingmessage').hide();
                window.location.href = "<?php echo base_url().'Alls_Fronens';?>"; 
                $('.tab-content').show();
                $('.nav').show();
                $('.container-fluid').show();
            }
        }
    })    
});
$(document).on('click','.close_art',function (){
    var SEQ_NO = $("#seq_no").val();
    //alert("Seqiuence No :"+SEQ_NO);   
    $.ajax({
        url: "<?php echo base_url().'close_plans1'; ?>",
        method: "POST",
        data: {SEQ_NO:SEQ_NO},
        dataType:"json",
        success: function (data) {
            if(data){                
                alert(data);
                window.location.href = "<?php echo base_url().'Alls_Fronens';?>"; 
            }
        }
    })    
});
$(document).on('click','.save_art',function (){
    $('#loadingmessage').show();
    $('.tab-content').hide();
    $('.nav').hide();
    $('.container-fluid').hide();
    $.ajax({
       url: "<?php echo base_url().'call_to_proceduer'?>",
       type: 'POST',
       success: function (data) {
           if(data){
               $('#loadingmessage').hide()();
                alert(data);
                window.location.href = "<?php echo base_url().'Alls_Fronens';?>"; 
                $('.tab-content').show();
                $('.nav').show();
                $('.container-fluid').show();
           }           
       }
    });
});
$(document).on('click','#plan_delete',function (){
    $.ajax({
        url: "<?php echo base_url().'delete_plan'?>",
        type: 'POST',
		success: function (data) {
               alert(data) ;       
        }
    });
});
$(document).on('click','#bom_delete',function (){
    $.ajax({
        url: "<?php echo base_url().'delete_bom'?>",
        type: 'POST',
		success: function (data) {
               alert(data) ;       
        }
    });
});

 </script> 