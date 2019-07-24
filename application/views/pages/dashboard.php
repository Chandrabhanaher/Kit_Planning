            <h2>Article Details</h2>
            <!--<p>BOM & STOCK & PLANS</p>-->

            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home">Articles</a></li>
              <li><a data-toggle="tab" href="#menu1">Overview</a></li>
              <!--<li><a data-toggle="tab" href="#menu2">Frozen Detials</a></li>-->
            </ul>

            <div class="tab-content">                
                <div id="home" class="tab-pane fade in active">                    
                     <div class="row">                          
                        <div class="col-md-12">                           
                            <div class="panel-body">                                 
                                <form id="frm-example" class="dt-body-center" method="POST" action="<?= base_url()?>showRecod">
                                    <p class="text-right">
                                    
                                        <?PHP if(isset($DEMO))
                                            {
                                               echo "<script type='text/javascript'>alert('$DEMO');</script>";
                                            }
                                        ?>
                                        <label>Search Frozen</label>
                                        <input type="text" name="frozen" placeholder="Y" style="width: 50px;text-align: center"/>
                                        <input type="submit" name="submit" value="submit">
                                    
                                </p>  
                                </form> 
                                <form id="frm-example" class="dt-body-center">
                                    <div class="table-responsive">  
                                        <table class="table table-hover table-striped table-bordered" id="customers">
                                            <thead>
                                                <tr>
                                                    <th>Sequence No</th>
                                                    <th>BOM Level</th>
                                                    <th>Priority</th>
                                                    <th>Article No.</th>
                                                    <th>Article Plan Qty.</th>
                                                    <th>Chaild Part</th>
                                                    <th>Stock Qty.</th>
                                                    <th>Child Part Qty.</th>
                                                    <th>Required Qty.</th>                            
                                                    <th>Stock %</th>
                                                    <th>In Frozen</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $i = 1;
                                                    foreach ($result as $value) {?>
                                                <tr>

                                                    <td><?php echo $value->SEQ_NO ;?></td>
                                                    <td><?php echo $value->BOLEVEL; ?></td>
                                                    <td><?php echo $value->PRIORITY; ?></td>
                                                    <td><?php echo $value->BOPARNT; ?></td>
                                                    <td><?php echo $value->QTY; ?></td>
                                                    <td><?php echo $value->BOCHILD ;?></td>
                                                    <td><?php echo $value->ILSTOCK; ?></td>
                                                    <td><?php echo $value->BOQTY; ?></td>
                                                    <td><?php echo $value->REQ_QTY; ?></td>
                                                    <td>
                                                        <?php if(($value->REQ_QTY)<=($value->ILSTOCK)){?>
                                                        <p style="background-color:#008000;" ><?php echo round(($value->ILSTOCK * 100)/$value->REQ_QTY,3)?></p>                                       
                                                        <?php }else if((($value->ILSTOCK * 100)/($value->REQ_QTY))<0){?>
                                                        <p style="background-color:#000000"><?php echo round(($value->ILSTOCK * 100)/$value->REQ_QTY,3)?></p>
                                                        <?php }else if((($value->ILSTOCK * 100)/($value->REQ_QTY))<=50 && ($value->REQ_QTY)<=($value->ILSTOCK)){ ?>
                                                        <p style="background-color:#FFFF00"><?php echo round(($value->ILSTOCK * 100)/$value->REQ_QTY,3)?></p>
                                                        <?php }else{?>
                                                        <p style="background-color:#FF0000"><?php echo round(($value->ILSTOCK * 100)/$value->REQ_QTY,3)?></p>
                                                        <?php }  ?>  
                                                    </td>
                                                    <td><?php if($value->FROZEN_FLAG){?>
                                                        <label style="color: green">Yes</label>                                                  
                                                    <?php }else{?>
                                                        <label style="color: #0e7ac4">NO</label>  
                                                     <?php }?></td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>                               
                            </div>
                        </div>
                    </div>
                </div> 
                <div id="menu1" class="tab-pane fade">
                    <h3>STOCK</h3>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <h3>Kiting PLAN </h3>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                </div>              
            </div>






