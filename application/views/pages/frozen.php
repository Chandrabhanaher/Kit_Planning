            <h2>Article Details</h2>
            <!--<p>BOM & STOCK & PLANS</p>-->
            <?php $tab = (isset($tab)) ? $tab : 'tab1'; ?> 
            <ul class="nav nav-tabs">
                
              <li class="<?php echo ($tab == 'tab1') ? 'active' : ''; ?>" > 
                  <a data-toggle="tab" href="#home">Articles</a>
              </li>
              <li class="<?php echo ($tab == 'tab2') ? 'active' : ''; ?>">
                  <a data-toggle="tab" href="#menu1">Add Frozen</a>
              </li>
              <li class="<?php echo ($tab == 'tab3') ? 'active' : ''; ?>" >
                  <a data-toggle="tab" href="#menu2">Frozen Detials</a>
              </li>
            </ul>

            <div class="tab-content">                
                <div id="home" class="tab-pane fade in active">                    
                     <div class="row">                          
                        <div class="col-md-12">                           
                            <div class="panel-body"> 
                                <h3>Articles</h3>                               
                                <form id="frm-example" method="POST" action="<?= base_url()?>f_trans" class="dt-body-center" name="bulk_action_form" onSubmit="return updateFlag_confirm();">
                                    <?php if(!empty($statusMsg)){
                                        echo "<script type='text/javascript'>alert('$statusMsg');</script>";   
                                    }?> 
                                     <?php if(!empty($message)){
                                        echo "<script type='text/javascript'>alert('$message');</script>";   
                                    }?>  
                                    <table class="table table-hover table-striped table-bordered" id="customers">
                                        <thead>
                                            <tr> 
                                                <th><input type="checkbox" id="select_all" value=""/></th>
                                                <th>Sr.No</th>
                                                <th>Sequence No.</th>
                                                 <th>Article No.</th>
                                                <th>Qty</th>
                                                <th>Priority</th>
                                                <th>Plan Date</th>  
                                                <th>Article Desc.</th>    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $i = 1;
                                                if(!empty($records)){
                                                    foreach ($records as $value) 
                                               
                                                {?>
                                            <tr>
                                                <td align="center"><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $value->SEQ_NO ; ?>"/></td>
                                                <td><?php echo $i++ ?></td>
                                                <td><?php echo $value->SEQ_NO ;?></td>
                                                <td><?php echo $value->ARTICLE_NO; ?></td>                                                
                                                <td><?php echo $value->QTY; ?></td>
                                                <td><?php echo $value->PRIORITY; ?></td>
                                                <td><?php echo $value->PLAN_DATE ;?></td>                                                
                                                <td><?php echo $value->ARTICLE_DEC; ?></td>                                               
                                                
                                            </tr>
                                            <?php } }else{?>
                                             <tr><td colspan="8">No records found.</td></tr>   
                                            <?php }?>
                                        </tbody>
                                    </table>
                                     <input type="submit" class="btn btn-primary" name="bulk_f_flag_submit" value="FROZEN FLAG"/>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div> 
                <div id="menu1" class="tab-pane fade">
                    <h4>FROZEN</h4>
                    <form id="frm-example1" method="POST" action="<?= base_url()?>showF_flag" class="dt-body-center" name="pick_flag_form" onSubmit="return pick_flag_confirm();">
                        <?php if(!empty($statusMsgs)){
                            echo "<script type='text/javascript'>alert('$statusMsgs');</script>";   
                        }?>  
                        <?php if(!empty($messages)){
                            echo "<script type='text/javascript'>alert('$messages');</script>";   
                        }?> 
                        <table class="table table-hover table-striped table-bordered" id="customers">
                            <thead>
                                <tr> 
                                    <th><input type="checkbox" id="select_alls" value=""/></th>
                                    <th>Sr.No</th>
                                    <th>Sequence No.</th>
                                    <th>Article No.</th>
                                    <th>Qty</th>
                                    <th>Priority</th>
                                    <th>Plan Date</th>  
                                    <th>Article Desc.</th> 
                                    <th>Frozen Flag</th>
                                    <th>PICK DATE</th>
                                 </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1;
                                    if(!empty($myRecords)){
                                        foreach ($myRecords as $row) 
                                               
                                    {?>
                                <tr>
                                    <td align="center"><input type="checkbox" name="checked_ids[]" class="checkbox1" value="<?php echo $row->SEQ_NO ; ?>"/></td>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $row->SEQ_NO ;?></td>
                                    <td><?php echo $row->ARTICLE_NO; ?></td>                                                
                                    <td><?php echo $row->QTY; ?></td>
                                    <td><?php echo $row->PRIORITY; ?></td>
                                    <td><?php echo $row->PLAN_DATE ;?></td>                                                
                                    <td><?php echo $row->ARTICLE_DEC; ?></td>
                                    <td><?php echo $row->FROZEN_FLAG; ?></td>   
                                    <td><?php echo $row->PICK_DATE;   ?></td>  
                                </tr>
                                <?php } }else{?>
                                <tr><td colspan="10">No records found.</td></tr>   
                                <?php }?>
                            </tbody>
                        </table>
                        <input type="submit" class="btn btn-primary" name="pick_flag_submit" value="PICK FLAG"/>
                        <button type="button" class="btn btn-primary pull-right" name="close_article" value="CLOSE FLAG" onclick="location.href='<?= base_url()?>close_frozen1'">CLOSE FLAG</button>
                    </form> 
                </div>
                <div id="menu2" class="tab-pane fade">
                    <h3>Kiting PLAN </h3>
                    <form>
                        
                    </form>
                </div>              
            </div>






