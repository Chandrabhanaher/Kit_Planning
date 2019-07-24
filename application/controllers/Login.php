<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->library('javascript');
        $this->load->library('javascript/jquery');
        $this->load->library('session');
        $this->load->model('LoginModel', 'logins');
        $this->load->model('Frozen');
    }

    public function index() {
        if(isset($this->session->userdata['logged_in'])){

            $data1 = array(
                'frozen_count'=>$this->Frozen->frozen_count(),
                'article_plan'=>$this->Frozen->article_plan(),
                'pick_article_plan'=>$this->Frozen->pick_article_plan(),
                'close_article_plan'=>$this->Frozen->close_article_plan()
            );       
            //$this->db->query("CALL insert_temp_bom()");
            $data['counts'] = json_encode($data1); 
            $this->load->helper('url');
            
            $sp1 = $this->session->userdata('header');                   
            $this->load->view($sp1);
            $this->load->view('pages/home_dashboard',$data);
            $this->load->view('include/page_footer');
        }else{
            $this->load->view('login/login');
        } 
        
    }
//    User Login
    public function user_login() {
        $user = $this->input->post('username');
        $pass = $this->input->post('password');
        
        if((empty($user)) &&(empty($pass))){
            $data1['message'] = 'Enter userId and password'; 
            $this->load->view('login/login',$data1);
        } else {
             $user = $this->input->post('username');
             $pass = $this->input->post('password');        
        
            $result = $this->logins->login_hear($user,$pass);
            $result11 = $this->logins->login_hear1($user,$pass);
            $result22 = $this->logins->login_hear2($user,$pass);
            $result33 = $this->logins->login_hear3($user,$pass);
            if($result33) {
                $user = $this->input->post('username');
                $resultt = $this->logins->read_user_information($user);
                if($resultt != FALSE){
                    $session_data = array(
                                        'username' => $resultt[0]->emp_id             
                                    );
                    $this->session->set_userdata('logged_in',$session_data); 

                    $sp = 'include/page_header';
                    $this->session->set_userdata('header',$sp);
                    $this->load->view('include/page_header');
                    $this->load->view('dashbo');
                    $this->load->view('include/page_footer');
                    $this->deletUploadFiles();
                }
            }elseif ($result22) {
                $user = $this->input->post('username');
                $resultt = $this->logins->read_user_information($user);
                if($resultt != FALSE){
                    $session_data = array(
                                            'username' => $resultt[0]->emp_id             
                                        );
                    $this->session->set_userdata('logged_in',$session_data);                                       

                    $sp = 'include/page_header1';
                    $this->session->set_userdata('header',$sp);
                    $this->load->view('include/page_header1');
                    $this->load->view('dashbo');
                    $this->load->view('include/page_footer');
                    $this->deletUploadFiles();
                }
            }else if($result11){
                $user = $this->input->post('username');
                $resultt = $this->logins->read_user_information($user);
                if($resultt != FALSE){
                    $session_data = array(
                                        'username' => $resultt[0]->emp_id             
                                    );
                    $this->session->set_userdata('logged_in',$session_data); 
                    $sp = 'include/page_header2';
                    $this->session->set_userdata('header',$sp);
                    $this->load->view('include/page_header2');
                    $this->load->view('dashbo');
                    $this->load->view('include/page_footer');
                    $this->deletUploadFiles();
                }
            
            } else if($result){
                $user = $this->input->post('username');
                $resultt = $this->logins->read_user_information($user);
                if($resultt != FALSE){
                    $session_data = array(
                                        'username' => $resultt[0]->emp_id             
                                    );
                    $this->session->set_userdata('logged_in',$session_data); 
                    $sp = 'include/page_header3';
                    $this->session->set_userdata('header',$sp);
                    $this->load->view('include/page_header3');
                    $this->load->view('dashbo');
                    $this->load->view('include/page_footer');
                    $this->deletUploadFiles();
                }
            
            } 
            else {
                 $data = array('error_message' => 'Invalid Username or Password');
                $this->load->view('login/login',$data);
            }
        }
    }
//    Forgot password
    public function forgot_pass() {       
        $email = $this->input->post('email');    
        if(isset($email)){
            $email_id = $this->logins->sendEmail($email);
            if(!empty($email_id)){
                $this->db->SELECT('emp_id')
                        ->SELECT('password')
                        ->FROM('users')
                        ->WHERE('email',$email);
                $query = $this->db->get();       
                $data['records'] = $query->result(); 
                $this->sendmail($email,$data);                
            } else {
                $data1['message'] = 'Enter your register email id'; 
                $this->load->view('login/login',$data1);
            }
        }else{
            $data1['message'] = 'Enter your register email id'; 
            $this->load->view('login/login',$data1);
        }
    }
    public function sendmail($email,$data){
        $this->load->helper('form');
        $this->load->library('email');
	$to = $email;
        
        $msg = $this->load->view('login/mail_view',$data,TRUE);       
        $subject = 'Username and Password';
        $this->email->from('ugcchakan@gmail.com')
                    ->reply_to('itsupport@ugclogistics.com')    // Optional, an account where a human being reads.
                    ->to($to)
                    ->subject($subject)
                    ->message($msg); 
        if ($this->email->send()){
            $data11['message'] = 'Mail Sent Success!'; 
            $this->load->view('login/login',$data11);
        }else{
            $data11['message'] = 'There is an Error For Sending Mail!'; 
            $this->load->view('login/login',$data11);
        }           
            
    }
    
    
    // Logout from admin page
    public function logout() {

        // Removing session data
        $sess_array = array(
            'username' => ''
        );
        
        $this->session->unset_userdata('logged_in', $sess_array);  
//        $this->db->select('*');
////        $this->db->from('tmp_bom');
//        $query = $this->db->get();
//        $count = $query->num_rows();
 //       if($count>0){
 //           $this->db->query('DELETE FROM `tmp_bom`');           
//        }
        $data['message_display'] = 'Successfully Logout';      
        $this->load->view('login/login', $data);
    }
    
    public function newReg() {
         $this->load->view('include/page_header');
        $this->load->view('login/user_reg');
        $this->load->view('include/page_footer');
    }
    public function addReg() {
        $name = $this->input->post('name');
        $emp_id = $this->input->post('emp_id');
        $pass = $this->input->post('password');
        $email = $this->input->post('email');
        $view = $this->input->post('view');
        $add = $this->input->post('add');
        $update = $this->input->post('update');
        $delete = $this->input->post('delete');
        $authss = $this->input->post('authUser');
        
        if(!empty($emp_id) && !empty($pass)&& !empty($email)){
            $sql = $this->db->query("SELECT * FROM users WHERE emp_id='$emp_id' || email='$email'");            
            $row = $sql->num_rows();
            if(!empty($row)){
                $data['msg'] = 'Employee ID and Email address already Reg';
                $this->load->view('login/user_reg',$data);
            }else{
               $this->db->query("INSERT INTO users(name,emp_id,password,email,add_right,view_right,delete_right,edit_right,login_right)"
                       . "VALUES('$name','$emp_id','$pass','$email','$add','$view','$delete','$update','$authss')");
                
               $data['msg'] = 'User register successfully';
               $this->load->view('login/login',$data);
            }
            
        } else {
            $data['msg'] = 'Fill all fields';
            $this->load->view('login/user_reg',$data);
        }
    }

    public function deletUploadFiles() {
        $m_img_real= $_SERVER['DOCUMENT_ROOT'].'/uploads/';
        $files = glob($m_img_real.'/*.xlsx');        
        foreach($files as $file){
            if(is_file($file))
            unlink($file); //delete file
        }
    }
}
