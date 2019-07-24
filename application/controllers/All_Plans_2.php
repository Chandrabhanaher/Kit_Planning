<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of All_Plans_2
 *
 * @author ugcch
 */
class All_Plans_2 extends CI_Controller{
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
//        else{
//            $username = ($this->session->userdata['logged_in']['username']);
//            $data12 = array(
//                'sq_no'=>$_POST['seq'],
//                'bo_pa'=>$_POST['al_plan'],
//                'usr'=>$username
//            );           
//            $this->all_article_plan->temp_bom($data12);            
//          
//        }
       echo json_encode($myData);  
    }
}
