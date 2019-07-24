<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alls_Fronens extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->database(); 
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model("all_frozen");       
    }
    public function index(){  
        $data['no_of_plan'] = $this->all_frozen->count_plan();
        $data['frozen_items'] = $this->all_frozen->frozen_items();
        $data['pick_plan'] = $this->all_frozen->pick_article_plan();
        $data['close_article'] = $this->all_frozen->close_article();
        $data["title"] = "Artical Plans Details";  
        $sp1 = $this->session->userdata('header');                   
        $this->load->view($sp1);
        $this->load->view('pages/all_frozens',$data); 
        $this->load->view('include/page_footer');
          
    }  
    public function fetch_user(){         
        $fetch_data = $this->all_frozen->make_datatables();       
        $data = array();          
        foreach($fetch_data as $row)  
           {  
                $sub_array = array();
                $sub_array[] = '';               
                $sub_array[] = $row->SEQ_NO;
                $sub_array[] = $row->ARTICLE_NO;  
                $sub_array[] = $row->QTY;  
                $sub_array[] = $row->PRIORITY;                  
                $sub_array[] = $row->ARTICLE_DEC;
                $red = $row->colorsss;
                
                if($red == 'Red'){
                     $sub_array[] = '<p style="color:#FF0000;">'.$row->colorsss.'</p>'; 
                }else{
                    $sub_array[] = '<p style="color:#008000;">'.$row->colorsss.'</p>';
                }                             
                               
                $sub_array[] = '<button type="button" name="update" id="'.$row->SEQ_NO.'" class="btn btn-success btn-xs update">Add</button>';  
                $sub_array[] = '<button type="button" name="plan_close" id="'.$row->SEQ_NO.'" class="btn btn-danger btn-xs plan_close">Close</button>';
                //$sub_array[] = "<a href = '".base_url()."print_frozen/".$row->SEQ_NO."'>Kit Print</a>";                 
                $data[] = $sub_array;  
           } 
           $output = array(  
                "draw"             =>     intval($_POST["draw"]),  
                "recordsTotal"     =>     $this->all_frozen->get_all_data(),  
                "recordsFiltered"  =>     $this->all_frozen->get_filtered_data(),  
                "data"             =>     $data  
           );  
           echo json_encode($output);  
    }
    public function update_frozen_flag() {        
        date_default_timezone_set('Asia/Kolkata');
        $datess = date("d-m-Y H:i:s");
        $pc_name1 = gethostname();
        $ip_add1 = file_get_contents("http://ipecho.net/plain");      
        $username = ($this->session->userdata['logged_in']['username']);
        $data1 = array(
            'SEQ_NO' => $_POST['SEQ_NO'],
	    'PLAN_DATE'=> $_POST['person'],
            'FROZEN_FLAG' => 'Y',
            'FROZEN_DATE' => $datess,
            'FROZEN_EMP_ID'=>$username
        );
        $this->db->select('*');
        $this->db->from('tmp_bom');
        $query = $this->db->get();
        $count = $query->num_rows();
        if($count>0){
           $this->db->query('DELETE FROM `tmp_bom`');           
        }        
        $query3 = $this->db->get_where('kiting_plan',array('SEQ_NO' => $_POST['SEQ_NO']));            
        foreach($query3->result() as $value1) {
            $ar_no1 = $value1->ARTICLE_NO;
            $sq_no1 = $value1->SEQ_NO;
        }         
        $data2 = array(           
            'SEQ_NO' => $sq_no1,
            'ARTICLE_NO' => $ar_no1,
            'ACTIVITY' => 'Add',
            'EMP_ID'=>$username,
            'PC_NAME'=>$pc_name1,
            'IP_ADDRESS'=>$ip_add1
        ); 
        $this->all_frozen->insertPickLog($data2);
        $this->all_frozen->updateFrozen_Flag($data1);        
        $this->db->query("CALL insert_temp_bom()");
        $data = 'Article added in frozen successfuly';        
        echo json_encode($data); 
    }
//  Article Added in frozen    
    public function update_frozen_flag1(){
        date_default_timezone_set('Asia/Kolkata');
        $datess = date("d-m-Y H:i:s");
        $pc_name1 = gethostname();
        $ip_add1 = file_get_contents("http://ipecho.net/plain");      
        $username = ($this->session->userdata['logged_in']['username']);
        $data1 = array(
            'SEQ_NO' => $_POST['SEQ_NO'],
	    'PLAN_DATE'=> $_POST['person'],
            'FROZEN_FLAG' => 'Y',
            'FROZEN_DATE' => $datess,
            'FROZEN_EMP_ID'=>$username
        );
        $query3 = $this->db->get_where('kiting_plan',array('SEQ_NO' => $_POST['SEQ_NO']));        
        $count = $query3->num_rows();
        if($count > 0){
           foreach($query3->result() as $value1) {
                $ar_no1 = $value1->ARTICLE_NO;
                $sq_no1 = $value1->SEQ_NO;
            }
            $data2 = array(           
                'SEQ_NO' => $sq_no1,
                'ARTICLE_NO' => $ar_no1,
                'ACTIVITY' => 'Add',
                'EMP_ID'=>$username,
                'PC_NAME'=>$pc_name1,
                'IP_ADDRESS'=>$ip_add1
            ); 
            $this->all_frozen->insertPickLog($data2);
            $this->all_frozen->updateFrozen_Flag($data1);
            $data = 'Article added in frozen successfuly';
            echo json_encode($data);
        }else{
            $data = 'Enter valid Sequence No.';
            echo json_encode($data);
        }
    }

    public function fetch_frozen() {       
        $fetch_data = $this->all_frozen->make_frozen();
        $data = array();  
        foreach($fetch_data as $row)  
           {  
                $sub_array = array();
                $sub_array[] = '';
                $sub_array[] = $row->SEQ_NO;
                $sub_array[] = $row->ARTICLE_NO;  
                $sub_array[] = $row->QTY;
                if($row->PRIORITY==''){
                    $sub_array[] = '<label id="'.$row->SEQ_NO.'" class="priority" style="color:#0000FF;">Set Priority</label>'; 
                }else{
                    $sub_array[] = $row->PRIORITY;
                }
                $sub_array[] = $row->PLAN_DATE;  
                $sub_array[] = $row->ARTICLE_DEC; 
                $sub_array[] = $row->FROZEN_DATE;
                $red = $row->colorsss;
                
                if($red == 'Red'){
                     $sub_array[] = '<p style="color:#FF0000;">'.$row->colorsss.'</p>'; 
                }else{
                    $sub_array[] = '<p style="color:#008000;">'.$row->colorsss.'</p>';
                }
                if($row->PICK_FLAG =='Y'){
                    $sub_array[] = '<p style="color:#5c5eed;">Picking Start</p>';  
                } else {
                    $sub_array[] = '<button type="button" name="pick" id="'.$row->SEQ_NO.'" class="btn btn-success btn-xs pick">Pick</button>';  
                }               
                $sub_array[] = '<button type="button" name="delete" id="'.$row->SEQ_NO.'" class="btn btn-danger btn-xs delete">Close</button>';
                $sub_array[] = "<a href = '".base_url()."export_frozen/".$row->SEQ_NO."'>Export</a>"; 
                $sub_array[] = "<a href = '".base_url()."print_frozen/".$row->SEQ_NO."'>Kit Print</a>"; 
                
                if($row->SCM_Remark ==''){
                    $sub_array[] = ''; 
                }else{
                    $sub_array[] = $row->SCM_Remark;
                }
                if($row->IBL_Remark==''){
                    $sub_array[] = '';
                }else{
                    $sub_array[] = $row->IBL_Remark;
                }                
                $sub_array[] = '<label id="'.$row->SEQ_NO.'" class="scm" style="color:#0000FF;">Enter SCM Remark</label>';       
                $sub_array[] = '<label id="'.$row->SEQ_NO.'" class="ibl" style="color:#0000FF;">Enter IBL Remark</label>';
                $data[] = $sub_array;  
           } 
           $output = array(  
                "draw"             =>     intval($_POST["draw"]),  
                "recordsTotal"     =>     $this->all_frozen->get_all_frozen(),  
                "recordsFiltered"  =>     $this->all_frozen->get_filtered_frozen(),  
                "data"             =>     $data  
           );  
           echo json_encode($output);
    }
    public function pick_frozen_flag(){      
        $this->db->select('*');
        $this->db->from('kiting_plan')
                ->where('PICK_FLAG','Y')
                ->where('SEQ_NO',$_POST["SEQ_NO"]);
        $query = $this->db->get();
        $count = $query->num_rows();
        if($count>0){
            $data = 'This plan already Picked';
        }else{
            date_default_timezone_set('Asia/Kolkata');
            $datess = date("d-m-Y H:i:s");
            $pc_name = gethostname();
            $ip_add = file_get_contents("http://ipecho.net/plain");
            $username = ($this->session->userdata['logged_in']['username']);
            $data1 = array(           
                'PICK_FLAG' => 'Y',
                'PICK_DATE' => $datess,
                'PICK_USER'=>$username
            );                
            $this->all_frozen->pickFrozen_Flag($data1,$_POST["SEQ_NO"]); 
            $query = $this->db->get_where("kiting_plan",array("SEQ_NO"=>$_POST["SEQ_NO"]));            
            foreach ($query->result() as $value) {
                $ar_no = $value->ARTICLE_NO;
                $sq_no = $value->SEQ_NO1;
            }         
            $data2 = array(           
                'SEQ_NO' => $sq_no,
                'ARTICLE_NO' => $ar_no,
                'ACTIVITY' => 'Pick',
                'EMP_ID'=>$username,
                'PC_NAME'=>$pc_name,
                'IP_ADDRESS'=>$ip_add
            ); 
           $this->all_frozen->insertPickLog($data2);
           $data = 'Frozen pick successfuly';
        }
       echo json_encode($data); 
    }
    
    public function priority_set(){    
            if(isset($_POST["SEQ_NO"]) && isset($_POST["PP"])){                        
            $data1=array(
                'PRIORITY'=>$_POST['PP']
            );
            $this->db->set('PRIORITY',false);
            $this->db->where('SEQ_NO',$_POST["SEQ_NO"]);
            $this->db->update('kiting_plan',$data1);            
            $data = "Successfully";                   
        }else{
            $data = "Enter Priority";  
        }            
        echo json_encode($data); 
    }
    public function scm_remark() {
        if(isset($_POST["SEQ_NO"]) && isset($_POST["PP"])){                        
            $data1=array(
                'SCM_Remark'=>$_POST['PP']
            );
            $this->db->set('SCM_Remark',false);
            $this->db->where('SEQ_NO',$_POST["SEQ_NO"]);
            $this->db->update('kiting_plan',$data1);            
            $data = "Successfully";                   
        }else{
            $data = "Enter Priority";  
        }            
        echo json_encode($data);
    }
    public function ibl_remark() {
        if(isset($_POST["SEQ_NO"]) && isset($_POST["PP"])){                        
            $data1=array(
                'IBL_Remark'=>$_POST['PP']
            );
            $this->db->set('IBL_Remark',false);
            $this->db->where('SEQ_NO',$_POST["SEQ_NO"]);
            $this->db->update('kiting_plan',$data1);            
            $data = "Successfully";                   
        }else{
            $data = "Enter Priority";  
        }            
        echo json_encode($data);
    }
//    Close Article =========================================
    public function close_article_plan() {
        date_default_timezone_set('Asia/Kolkata');
        $datess = date("d-m-Y H:i:s");
        $pc_name = gethostname();
        $ip_add = file_get_contents("http://ipecho.net/plain");
        $username = ($this->session->userdata['logged_in']['username']);
        $data1 = array(           
            'A_CLOSE_DATE' => $datess,
            'A_CLOSE_FLAG' => 'Y',
            'A_CLOSE_USER'=>$username
        );
        $this->db->select('*');
        $this->db->from('tmp_bom');
        $query = $this->db->get();
        $count = $query->num_rows();
         if($count>0){
           $this->db->query('DELETE FROM `tmp_bom`');           
        }
        $this->all_frozen->closeFrozen_Flag($data1,$_POST["SEQ_NO"]);
        $this->db->query("CALL insert_temp_bom()");
        $query1 = $this->db->get_where("kiting_plan",array("SEQ_NO"=>$_POST["SEQ_NO"]));            
        foreach($query1->result() as $value) {
            $ar_no = $value->ARTICLE_NO;
            $sq_no = $value->SEQ_NO;
        }         
        $data2 = array(           
            'SEQ_NO' => $sq_no,
            'ARTICLE_NO' => $ar_no,
            'ACTIVITY' => 'Close',
            'EMP_ID'=>$username,
            'PC_NAME'=>$pc_name,
            'IP_ADDRESS'=>$ip_add
        ); 
        $this->all_frozen->insertPickLog($data2);
        $data = 'Article Plan Close Successfully';
        echo json_encode($data); 
    }
    public function close_article_plan1(){
        date_default_timezone_set('Asia/Kolkata');
        $datess = date("d-m-Y H:i:s");
        $pc_name = gethostname();
        $ip_add = file_get_contents("http://ipecho.net/plain");
        $username = ($this->session->userdata['logged_in']['username']);
        $data1 = array(           
            'A_CLOSE_DATE' => $datess,
            'A_CLOSE_FLAG' => 'Y',
            'A_CLOSE_USER'=>$username
        );
        $this->all_frozen->closeFrozen_Flag($data1,$_POST["SEQ_NO"]);      
        $query1 = $this->db->get_where("kiting_plan",array("SEQ_NO"=>$_POST["SEQ_NO"]));            
        foreach($query1->result() as $value) {
            $ar_no = $value->ARTICLE_NO;
            $sq_no = $value->SEQ_NO;
        }         
        $data2 = array(           
            'SEQ_NO' => $sq_no,
            'ARTICLE_NO' => $ar_no,
            'ACTIVITY' => 'Close',
            'EMP_ID'=>$username,
            'PC_NAME'=>$pc_name,
            'IP_ADDRESS'=>$ip_add
        ); 
        $this->all_frozen->insertPickLog($data2);
        $data = 'Article Plan Close Successfully';
        echo json_encode($data);  
    }
//  Save in Proceduer
    public function data_opration(){
        $this->db->query("CALL insert_temp_bom()");
        $data = 'Save Successfully';
        echo json_encode($data); 
    }
//  Frozen Close
    public function close_frozen_flag(){
        date_default_timezone_set('Asia/Kolkata');
        $datess = date("d-m-Y H:i:s");
        $pc_name = gethostname();
        $ip_add = file_get_contents("http://ipecho.net/plain");
        $username = ($this->session->userdata['logged_in']['username']);
        $data1 = array(           
            'A_CLOSE_DATE' => $datess,
            'A_CLOSE_FLAG' => 'Y',
            'A_CLOSE_USER'=>$username
        );  
	
        $this->all_frozen->closeFrozen_Flag($data1,$_POST["SEQ_NO"]);        
        $query1 = $this->db->get_where("kiting_plan",array("SEQ_NO"=>$_POST["SEQ_NO"]));            
        foreach($query1->result() as $value) {
            $ar_no = $value->ARTICLE_NO;
            $sq_no = $value->SEQ_NO1;
        }         
        $data2 = array(           
            'SEQ_NO' => $sq_no,
            'ARTICLE_NO' => $ar_no,
            'ACTIVITY' => 'Close',
            'EMP_ID'=>$username,
            'PC_NAME'=>$pc_name,
            'IP_ADDRESS'=>$ip_add
        ); 
        $this->all_frozen->insertPickLog($data2);
        $data = 'Frozen Close successfuly';
        echo json_encode($data); 
    }    
    
    public function fristLeves() {
        $myData = array();
        header('Content-Type: application/x-json; charset=utf-8');
        $result = $this->all_frozen->frist_level($_POST['seq'],$_POST['al_plan']);
        foreach ($result as $row) {            
            $myData[] = $row;            
        }
        echo json_encode($myData);
    }
    public function secondLevel() {
        $child_bom = array();
        header('Content-Type: application/x-json; charset=utf-8');
        $result = $this->all_frozen->second_level($_POST['boparnt'],$_POST['boChild']);       
        foreach ($result as $row){            
            $child_bom[] = $row;            
        }         
        echo json_encode($child_bom);
    }
    public function thirdLevel(){
        $third_bom = array();
        header('Content-Type: application/x-json; charset=utf-8');
        $result = $this->all_frozen->third_level($_POST['tdChild']);       
        foreach ($result as $row){            
            $third_bom[] = $row;            
        }         
        echo json_encode($third_bom);
    }
}
