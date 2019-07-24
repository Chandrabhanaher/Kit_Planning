# Php Codeigitor Fremwork
Using Ajax, Jquery, JavaScript , css.

```Using Mysql Database 
Change the database name in database.php file

``Create PDF
```# Ajax Code

```$(document).on('click','.priority',function (){
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
``` });

