                        <?php
                            if(isset($message)){
                                echo "<script type='text/javascript'>alert('$message');</script>"; 
                                redirect('upload_doc','refresh');
                            }
                        ?>
            <h2>Import / Export</h2>
            <p>Import BOM & STOCK & PLANS Excel files</p>
            
<!--            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home">Import</a></li>
              <li><a data-toggle="tab" href="#menu1">Export</a></li>
            </ul>-->

            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home">BOM</a></li>
              <li><a data-toggle="tab" href="#menu1">PLAN</a></li>
              <li><a data-toggle="tab" href="#menu2">STOCK</a></li>
              <li><a data-toggle="tab" href="#menu3">Location Master</a></li>
            </ul>

            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">                
                <div class="container">                  
                    <div class="right">
                        <p>Delete BOM Data</p>
                        <input type="submit" name="bom_delete" id="bom_delete" value="Delete" /><br><br>
                    </div>
                    <br>
                    <h3>UPLOAD BOM (Bill of Materials) FILE </h3><br>
                    <h5 style="color: red"><label for="male">BOM upload last date : <label for="male"><?php echo $boms;?></label></label></h5>
                    <br>
                    <form action="<?php echo base_url();?>import_bom" method="post" enctype="multipart/form-data">
                        
                        <h4>Upload excel file :</h4>
                        <br>                       
                        <input type="file" name="uploadFile" value="" /><br><br>
                        <input type="submit" name="submit" value="Upload" /><br><br>
                        <!--<a href="<?= base_url();?>create_Excel1">Excel Report</a>-->
                    </form>
                </div>
               
              </div>
              <div id="menu1" class="tab-pane fade">
                  <div class="container">
                    <div class="right">
                        <p>Delete Article Plan Date</p>
                        <input type="submit" name="plan_delete" id ="plan_delete" value="Delete" /><br><br>
                    </div>
                        <br>
                        <h3>UPLOAD KITING PLAN FILE</h3><br>
                        <h5 style="color: red"><label for="male">Article Plan upload last date : <label for="male"><?php echo $plan;?></label></label></h5>	
                        <br>                      
                        <form action="<?= base_url();?>import_kiting_plans/" method="post" enctype="multipart/form-data">
                            
                            <h4>Upload excel file :</h4> 
                           <br>                           
                           <input type="file" name="uploadFile" value="" /><br><br>
                           <input type="submit" name="submit" value="Upload" /><br><br>
                           <a href="<?= base_url();?>create_Excel">Excel Report</a>
                           
                       </form>
                  </div>                
              </div>
              <div id="menu2" class="tab-pane fade">
                  <div class="container">                  
                       <br>
                        <h3>UPLOAD STOCK FILE</h3><br>
                        <h5 style="color: red"><label for="male">Stock upload last date : <label for="male"><?php echo $stocks;?></label></label></h5>
                        <br>
                        
                        <form action="<?php echo base_url();?>import_stocks" method="post" enctype="multipart/form-data">
                          
                            <h4>Upload excel file :</h4>
                           <br>                           
                           <input type="file" name="uploadFile" value="" /><br><br>
                           <input type="submit" name="submit" value="Upload" /><br><br>
                           
                       </form>
                  </div>                               
              </div> 
              <div id="menu3" class="tab-pane fade">
                  <div class="container">
                       
                      <br>
                        <h3>UPLOAD LOCATION MASTER FILE</h3><br>
                        <h5 style="color: red"><label for="male">Location Master upload last date : <label for="male"><?php echo $loc;?></label></label></h5>
                        <br>
                        
                        <form action="<?php echo base_url();?>location_master" method="post" enctype="multipart/form-data">
                          
                            <h4>Upload excel file :</h4>
                           <br>                           
                           <input type="file" name="uploadFile" value="" /><br><br>
                           <input type="submit" name="submit" value="Upload" /><br><br>
                           
                       </form>
                  </div>                    
              </div>
            </div>

