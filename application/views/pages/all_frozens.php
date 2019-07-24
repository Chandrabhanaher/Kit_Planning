
<div class="container">
    <ul class="nav navbar-nav navbar-right">
        <li>
            <label>Article Plans : = <label style="color: green"><?php echo $no_of_plan?></label></label>&nbsp;&nbsp;
        </li>
        <li>
            <label>Frozen Items  : = <label style="color: green"><?php echo $frozen_items?></label></label>&nbsp;&nbsp;
        </li>
        <li>
            <label>Pick Articles : = <label style="color: #66afe9"><?php echo $pick_plan?></label></label>&nbsp;&nbsp;
        </li>
        <li>
            <label>Close Article : = <label style="color: red"><?php echo $close_article?></label></label>
        </li>
    </ul>
</div> 
            <?php $tab = (isset($tab)) ? $tab : 'tab1'; ?> 
            <ul class="nav nav-tabs">
                
              <li class="<?php echo ($tab == 'tab1') ? 'active' : ''; ?>" > 
                  <a data-toggle="tab" href="#home">Article Plan</a>
              </li>
              <li class="<?php echo ($tab == 'tab2') ? 'active' : ''; ?>">
                  <a data-toggle="tab" href="#menu1">Frozen</a>
              </li>
              <li class="<?php echo ($tab == 'tab3') ? 'active' : ''; ?>" >
                  <a data-toggle="tab" href="#menu2">Report</a>
              </li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
<!--                    <h3 align="center"><?php echo $title; ?></h3>-->
                    <div class="table-responsive"> 
                        <br>
                       <p style="text-align: end;font-size:14px;">
                                <input type="text" id="seq_no" name="seq_no" placeholder="Enter Sequence No." />
                                <button type="button" name="add" class="btn btn-success btn-xs add_art">Add Frozen</button>
                                <button type="button" name="closes" class="btn btn-danger btn-xs close_art">Article Close</button>
                                <button type="button" name="save" class="btn btn-success btn-xs save_art">Save</button><br><br>
                                <u><a style="text-align: end" href="<?= base_url().'create_Excel'?>">Download Open Article Plan</a></u>
                        </p>
                       
                            
                          
                        <table id="user_data" class="table table-bordered table-striped">  
                            <thead>  
                                <tr>  
                                    <th width="2%"></th>
                                    <th width="9%">Seq. No.</th>  
                                    <th width="11%">Article No.</th>  
                                    <th width="8%">Qty.</th>  
                                    <th width="8%">Priority</th>                                    
                                    <th width="15%">Description</th>
                                    <th width="3%">Status</th>
                                    <th width="3%">Add</th> 
                                    <th width="3%">Close</th>
                                    <!--<th width="3%">Print</th>-->
                                </tr>  
                            </thead>  
                        </table>  
                    </div>                                 
                                                   
                </div>                
                <div id="menu1" class="tab-pane fade">                    
<!--                     <h3 align="center"></h3>-->
                    <div class="table-responsive">
                        <br>
                        <u> <p style="text-align: end;font-size:14px;color: blue;"><a href="<?= base_url().'temp_bom'?>">Download BOM File</a></p> 
                            <p style="text-align: end;font-size:14px;color: blue;"><a href="<?= base_url().'frozen_plan'?>">Download Frozen Plan</a></p>   
                        </u>   
                        <table id="frozens_data" class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="7%" style="padding: 15px;"></th>
                                    <th width="7%">Seq.No.</th>  
                                    <th width="7%">Article No</th>  
                                    <th width="7%">Qty</th>  
                                    <th width="7%">Priority</th>
                                    <th width="7%">Plan Date</th>
                                    <th width="7%">Article Desc.</th>                                    
                                    <th width="7%">Frozen Date.</th>
                                    <th width="7%">Status</th>
                                    <th width="7%">Pick</th> 
                                    <th width="7%">Close</th> 
                                    <th width="7%">Export</th>
                                    <th width="7%">Print</th> 
                                    <th width="7%">SCM Remark</th>
                                    <th width="7%">IBL Remark</th>
                                    <th width="7%"></th>
                                    <th width="7%"></th>
                                </tr>
                            </thead>                  
                        </table>
                    </div>
                </div> 
                <div id="menu2" class="tab-pane fade">  
                    <div class="table-responsive"> 
                        <br>
                        <u> <p style="text-align: end;font-size:14px;color: blue;"><a href="<?= base_url().'reports'?>">Download Close Article Plan Report</a></p>   </u>   
                        <table id="report_data" class="table table-bordered table-striped" style="width: 100%">  
                            <thead>  
                                <tr>                                    
                                    <th width="10%">Seq.No.</th>  
                                    <th width="12%">Article No.</th>
                                    <th width="15%">Description</th>
                                    <th width="15%">Qty.</th>                                     
                                    <th width="15%">SCM Remark</th>
                                    <th width="15%">IBL Remark</th> 
                                    <th width="10%">Close Date</th>                                  
                                </tr>  
                            </thead>  
                        </table>  
                    </div>         
                </div>
            </div>