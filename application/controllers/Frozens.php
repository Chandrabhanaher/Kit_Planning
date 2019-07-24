<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frozens extends CI_Controller  {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();        
        $this->load->library('session');
        $this->load->model('Frozen');
    }
    public function frozen() {             
        $data['records'] = $this->Frozen->kiiting_Details(); 
        $data['myRecords'] = $this->Frozen->frozen_Details();         
        $sp1 = $this->session->userdata('header');                   
        $this->load->view($sp1);
        $this->load->view('pages/frozen',$data);
        $this->load->view('include/page_footer');
    }
    
    public function trans() {
        $data = array();
        if($this->input->post('bulk_f_flag_submit')){         
            $ids = $this->input->post('checked_id');            
             // If id array is not empty
            if(!empty($ids)){             
               $u_f_flag = '$ids';
                if($u_f_flag){
                    $data['statusMsg'] = json_encode($ids); 
                    date_default_timezone_set('Asia/Kolkata');
                    $datess = date("d-m-Y H:i:s");
                    $username = ($this->session->userdata['logged_in']['username']);
                    $data = array(           
                        'FROZEN_FLAG' => 'Y',
                        'FROZEN_DATE' => $datess,
                        'FROZEN_EMP_ID'=>$username
                    ); 
                    $this->Frozen->updateFrozen_Flag($data,$ids);                    
                    $data['message'] = 'Frozen add in flag Successfully';                    
                    $data['records'] = $this->Frozen->kiiting_Details(); 
                    $data['myRecords'] = $this->Frozen->frozen_Details();                 
                }else{
                    $data['statusMsg'] = 'Some problem occurred, please try again.';
                }
            }else{
                $data['statusMsg'] = 'Select at any 1 article no.';
            }
        }
        $this->load->view('include/page_header');
        $this->load->view('pages/frozen',$data);
        $this->load->view('include/page_footer'); 
    }
    public function showFrozen_flag() {
       
        if($this->input->post('pick_flag_submit')){
          
            $flag = $this->input->post('checked_ids');            
             // If id array is not empty
            if(!empty($flag)){ 
                $data1['statusMsgs'] = json_encode($flag);  
                $sql = $this->db->select('*')
                        ->from('kiting_plan')
                        ->where_in('SEQ_NO',$flag)
                        ->where_in('PICK_FLAG','Y')->get();
                 $count = $sql->num_rows();
                 if($count > 0){
                    $data1['messages'] = 'Frozen alreday picked'; 
                    $data1['records'] = $this->Frozen->kiiting_Details(); 
                    $data1['myRecords'] = $this->Frozen->frozen_Details();
                 }else{
                    date_default_timezone_set('Asia/Kolkata');
                    $datess = date("d-m-Y H:i:s");
                    $username = ($this->session->userdata['logged_in']['username']);
                    $data1 = array(           
                        'PICK_FLAG' => 'Y',
                        'PICK_DATE' => $datess,
                        'PICK_USER'=>$username
                    );               
                    $this->Frozen->updatePick_Flag($data1,$flag);
                    $data1['messages'] = 'Frozen pick successfully';                    
                    $data1['records'] = $this->Frozen->kiiting_Details();    
                    $data1['myRecords'] = $this->Frozen->frozen_Details();                    
//                    $data1['tab'] = 'tab2';  
                 }                
            }else{
                $data1['statusMsgs'] = 'Select at any 1 article no.';
            }
        }     
        $sp1 = $this->session->userdata('header');                   
        $this->load->view($sp1);
        $this->load->view('pages/frozen',$data1);
        $this->load->view('include/page_footer');    
    }
    public function frozen_close() {
       
            $flag = $this->input->post('checked_ids');    
            if(!empty($flag)){
                $data2['statusMsgs'] = json_encode($flag);
               $data2['records'] = $this->Frozen->kiiting_Details();    
            } else {
                $data2['statusMsgs'] = 'Select at any 1 article no.';
                $data2['records'] = $this->Frozen->kiiting_Details(); 
            }
               
           $sp1 = $this->session->userdata('header');                   
           $this->load->view($sp1);
           $this->load->view('pages/frozen',$data2);
           $this->load->view('include/page_footer');
     
    }
    
}
