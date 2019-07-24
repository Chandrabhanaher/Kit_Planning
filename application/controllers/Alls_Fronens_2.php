<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Alls_Fronens_2
 *
 * @author ugcch
 */
class Alls_Fronens_2 extends CI_Controller{
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
        $this->load->view('user/all_frozens2',$data); 
        $this->load->view('include/page_footer');
    } 
     public function fetch_user(){         
        $fetch_data1 = $this->all_frozen->make_datatables1();       
        $data = array();          
        foreach($fetch_data1 as $row)  
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
    public function fetch_frozen() {       
        $fetch_data11 = $this->all_frozen->make_frozen1();
        $data = array();  
        foreach($fetch_data11 as $row)  
           {  
                $sub_array = array();
                $sub_array[] = '';
                $sub_array[] = $row->SEQ_NO;
                $sub_array[] = $row->ARTICLE_NO;  
                $sub_array[] = $row->QTY;  
                $sub_array[] = $row->PRIORITY;
                $sub_array[] = $row->PLAN_DATE;  
                $sub_array[] = $row->ARTICLE_DEC; 
                $sub_array[] = $row->FROZEN_DATE;
                $red = $row->colorsss;
                
                if($red == 'Red'){
                     $sub_array[] = '<p style="color:#FF0000;">'.$row->colorsss.'</p>'; 
                }else{
                    $sub_array[] = '<p style="color:#008000;">'.$row->colorsss.'</p>';
                }                
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
                $sub_array[] = '<label id="'.$row->SEQ_NO.'" class="ibl1" style="color:#0000FF;">Enter IBL Remark</label>';
                
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
}
