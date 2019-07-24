<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_Plans extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->database(); 
        $this->load->helper('form');
        $this->load->helper('url','mysqli');
        $this->load->model("all_article_plan");       
    }
    public function index(){  
       
        $data["title"] = "Artical Plans Details";  
        $sp1 = $this->session->userdata('header');                   
        $this->load->view($sp1);
        $this->load->view('pages/all_plan',$data); 
        $this->load->view('include/page_footer');
          
      }
    public function fetch_frozen() {       
        $result = $this->all_article_plan->make_plan();
        $data = array();  
        foreach($result as $row) {  
                $sub_array = array();
                $sub_array[] = '';
                $sub_array[] = $row->SEQ_NO;
                $sub_array[] = $row->BOLEVEL;  
                $sub_array[] = $row->PRIORITY;  
                $sub_array[] = $row->BOPARNT;
                $sub_array[] = $row->QTY;  
                $sub_array[] = $row->BOCHILD; 
                $sub_array[] = $row->ILSTOCK;
                $sub_array[] = $row->BOQTY;
                $sub_array[] = $row->REQ_QTY;
                if(($row->REQ_QTY)<=($row->ILSTOCK)){
                   $sub_array[] = '<p style="background-color:#008000;">'.round(($row->ILSTOCK * 100)/$row->REQ_QTY,3).'</p>';                    
                }else if((($row->ILSTOCK * 100)/($row->REQ_QTY))<0){
                    $sub_array[] = '<p style="background-color:#000000;">'.round(($row->ILSTOCK * 100)/$row->REQ_QTY,3).'</p>';                     
                }else if((($row->ILSTOCK * 100)/($row->REQ_QTY))<=50 && ($row->REQ_QTY)<=($row->ILSTOCK)){
                    $sub_array[] = '<p style="background-color:#FFFF00;">'.round(($row->ILSTOCK * 100)/$row->REQ_QTY,3).'</p>';                    
                }else{
                    $sub_array[] = '<p style="background-color:#FF0000;">'.round(($row->ILSTOCK * 100)/$row->REQ_QTY,3).'</p>';                    
                }
                if($row->FROZEN_FLAG){
                     $sub_array[] ='<label style="color: green">Yes</label>';   
                }else{
                     $sub_array[] ='<label style="color: green">Yes</label>' ;  
                }                
                $data[] = $sub_array;  
           } 
           $output = array(  
                "draw"             =>     intval($_POST["draw"]),  
                "recordsTotal"     =>     $this->all_article_plan->get_all_plan(),  
                "recordsFiltered"  =>     $this->all_article_plan->get_filtered_plan(),  
                "data"             =>     $data  
           );  
           echo json_encode($output);
    }
//    Cose dtae wise report
    public function close_datewise_report() {
        $result = $this->all_article_plan->close_kit_report();
        $data = array();
        foreach($result as $row) {  
                $sub_array = array();                
                $sub_array[] = $row->SEQ_NO;
                $sub_array[] = $row->ARTICLE_NO;
                $sub_array[] = $row->ARTICLE_DEC;
                $sub_array[] = $row->QTY;
                $sub_array[] = $row->SCM_Remark;
                $sub_array[] = $row->IBL_Remark;
                $sub_array[] = $row->A_CLOSE_DATE;                
                $data[] = $sub_array; 
        }
        $output = array(  
            "draw"             =>     intval($_POST["draw"]),
            "recordsTotal"     =>     $this->all_article_plan->get_all_closeKit_repoprt(),
            "recordsFiltered"  =>     $this->all_article_plan->get_filtered_record(), 
            "data"             =>     $data  
        );
        echo json_encode($output);
    }
//    End close date wise report
    public function second_level(){
        $myData = array();
        header('Content-Type: application/x-json; charset=utf-8');
        $result = $this->all_article_plan->fetch_child_part($_POST['LPROD']);
        foreach ($result as $row) {
            
            $myData[] = $row;
            
        }
        echo json_encode($myData); 
         
    }
    public function bomLevel(){
        $myData = array();
        
        header('Content-Type: application/x-json; charset=utf-8');  
        $this->db->select('*');
        $this->db->from('tmp_bom as b')               
                ->where('b.sq_no',$_POST['seq'])
                ->where('b.p_id',$_POST['al_plan']);
        $query = $this->db->get();
        $count = $query->num_rows();
        if($count>0){      
            $result = $this->all_article_plan->bom_level($_POST['seq'],$_POST['al_plan']);
            foreach ($result as $row) {            
                $myData[] = $row;            
            }            
        }
       echo json_encode($myData);  
    }
    
    function temp_table_insert() {
      $myData1 = array();
      $this->db->select('*');
                $this->db->from('tmp_bom');
                $query = $this->db->get();
                $count = $query->num_rows();
                 if($count>0){
                   $this->db->query('DELETE FROM `tmp_bom`');           
                }
      $this->db->query("CALL insert_temp_bom()");   
      $myData1[]='Welcome to ATLAS COPCO';
      echo json_encode($myData1);
    }
    
    function plan_delete() {
        $this->db->select('*');
        $this->db->from('kiting_plan');
        $query = $this->db->get();
        $count = $query->num_rows();
        if($count>0){
            $this->db->query('DELETE FROM `kiting_plan` WHERE FROZEN_FLAG IS NULL AND A_CLOSE_FLAG IS NULL');
			$data = "Plan is deleted";			
        }
		echo json_encode($data);
    }
    function bom_delete() {
        $this->db->select('*');
        $this->db->from('bom');
        $query = $this->db->get();
        $count = $query->num_rows();
        if($count>0){
            $this->db->query('DELETE FROM `bom`'); 
			$data = "Plan is deleted";			
        }
		echo json_encode($data);
    }
}
