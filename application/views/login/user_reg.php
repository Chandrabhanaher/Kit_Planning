<div class="container text-center" style="width: 35%">            
            <form  role="form" method="post" action="<?= base_url()?>userReg">   
                          <?php
                            if(isset($msg)){
                                 echo "<script type='text/javascript'>alert('$msg');</script>";          
                            }
                          ?>
                            <div class="modal-body mx-3">
                                <div class="md-form mb-3">
                                   <i class="fas fa-envelope prefix grey-text"></i>
                                    <div class="form-group">                                
                                        <input type="text" name="name" id="name" class="form-control validate" autofocus required placeholder="Enter Name"/>
                                    </div>                            
                                </div>
                                <div class="md-form mb-3">
                                     <i class="fas fa-envelope prefix grey-text"></i>
                                    <div class="form-group">                                
                                        <input type="text" name="emp_id" id="emp_id" class="form-control validate" autofocus required placeholder="Enter Employee ID"/>
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
                                        <input type="email" name="email" id="email" class="form-control validate" autofocus required placeholder="Enter Email"/>
                                    </div>                            
                                </div>
                                <div class="md-form mb-3">
                                     <i class="fas fa-envelope prefix grey-text"></i>
                                    <div class="form-group text-left"> 
                                            <label class="heading">Select Your Technical Exposure:</label><br>
                                            &nbsp;&nbsp;&nbsp;<input type="checkbox" name="view" value="1"><label>&nbsp;:&nbsp;View and Edit Frozen</label><br>
                                            &nbsp;&nbsp;&nbsp;<input type="checkbox" name="add" value="1"><label>&nbsp;:&nbsp;Add BOM/STOCK/PLAN</label><br>
                                            &nbsp;&nbsp;&nbsp;<input type="checkbox" name="authUser" value="1"><label>&nbsp;:&nbsp;Auth. User</label><br>
                                    </div>                            
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-hover btn-primary" name="submit">
                                        Submit
                                    </button>
                              </div> 
                            </div>                      
                       </form>
                  </div>                   
 