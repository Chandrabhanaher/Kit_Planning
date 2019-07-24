<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();        
        $this->load->library('session');
        $this->load->model('Import_Ex_Files', 'import_files');
        $this->load->model('Frozen');    
        $this->load->helper('string'); 
    }

    public function index(){        
        $this->load->view('pages/home');       
    }
    public function dashboard(){
        $this->db->SELECT('kiting_plan.SEQ_NO,bom.BOLEVEL,kiting_plan.PRIORITY,bom.BOPARNT,kiting_plan.QTY,bom.BOCHILD,stock.ILSTOCK,bom.BOQTY,(kiting_plan.QTY *bom.BOQTY) as REQ_QTY,kiting_plan.FROZEN_FLAG')                       
                ->FROM('bom,kiting_plan,stock')
                ->WHERE("kiting_plan.ARTICLE_NO = bom.BOPARNT and bom.BOCHILD = stock.LPROD")
                ->ORDER_BY('kiting_plan.PRIORITY','ASC');        
        $query = $this->db->get();       
        $data['result'] = $query->result();
        $this->load->helper('url');
        $sp1 = $this->session->userdata('header');                   
        $this->load->view($sp1);
        $this->load->view('pages/dashboard',$data);
        $this->load->view('include/page_footer');
    }
    public function upload_files() {
	$d = $this->import_files->plan_last_upload();
	foreach($d as $row){
            $plan['plan'] = $row->dates;
	}
	$d1 = $this->import_files->bom_last_upload();
	foreach($d1 as $row1){
            $plan['boms'] = $row1->dates;
	}
	$d2 = $this->import_files->stock_last_upload();
	foreach($d2 as $row2){
            $plan['stocks'] = $row2->dates;
	}
        $d3 = $this->import_files->loc();
	foreach($d3 as $row3){
            $plan['loc'] = $row3->dates;
	}
        $sp1 = $this->session->userdata('header');                   
        $this->load->view($sp1);
        $this->load->view('pages/upload_file',$plan);
        $this->load->view('include/page_footer');
    }
    public function upload_file1() {
        $d = $this->import_files->plan_last_upload();
	foreach($d as $row){
            $plan['plan'] = $row->dates;
	}
	$d1 = $this->import_files->bom_last_upload();
	foreach($d1 as $row1){
            $plan['boms'] = $row1->dates;
	}
	$d2 = $this->import_files->stock_last_upload();
	foreach($d2 as $row2){
            $plan['stocks'] = $row2->dates;
	}
        $d3 = $this->import_files->loc();
	foreach($d3 as $row3){
            $plan['loc'] = $row3->dates;
	}
        $sp1 = $this->session->userdata('header');                   
        $this->load->view($sp1);
        $this->load->view('pages/upload_1',$plan);
        $this->load->view('include/page_footer');
    }
    
    public function import_kiting_plan() {         
        $username = ($this->session->userdata['logged_in']['username']);
        $ip_add = file_get_contents("http://ipecho.net/plain"); 
        
        $path = 'uploads/';
        require_once APPPATH . "/third_party/PHPExcel.php";
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);            
        if (!$this->upload->do_upload('uploadFile')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        if(empty($error)){
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            }else{
                $import_xls_file = 0;                    
            }
            $inputFileName = $path . $import_xls_file;           
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                //$objReader->setLoadSheetsOnly('Kitting plan file');
                $objPHPExcel = $objReader->load($inputFileName);
                $results = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i=0;
                foreach ($results as $value) {
                    if($flag){
                        $flag = false;
                        continue;
                    }
                    $kit_plan[$i]['ARTICLE_NO'] = $value['B'];
                    $kit_plan[$i]['ARTICLE_DEC'] = $value['C'];
                    $kit_plan[$i]['QTY'] = $value['D'];
                    $kit_plan[$i]['PLAN_DATE'] = $value['E'];
                    $kit_plan[$i]['PRIORITY'] = $value['F'];
                    $kit_plan[$i]['EMP_ID'] = $username;
                    $kit_plan[$i]['IP_ADDRESS'] = $ip_add;
                    $i++;
                }
                $this->db->select('*');
                $this->db->from('tmp_bom');
                $query = $this->db->get();
                $count = $query->num_rows();
                 if($count>0){
                   $this->db->query('DELETE FROM `tmp_bom`');           
                }
                $result = $this->import_files->upload_file($kit_plan);   
                if($result){
                    $this->db->query("CALL insert_temp_bom()");
                    $data1['message']='File Imported Successfully';                     
                    $sp1 = $this->session->userdata('header');                   
                    $this->load->view($sp1);
                    $this->load->view('pages/upload_file',$data1);
                    $this->load->view('include/page_footer');
                    
                }else{ 
                    $data1['message']='File has been not Imported';  //                     
                    $sp1 = $this->session->userdata('header');                   
                    $this->load->view($sp1);
                    $this->load->view('pages/upload_file',$data1);
                    $this->load->view('include/page_footer');  
                                   
                }             

            }catch (Exception $e) {
                 die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME). '": ' .$e->getMessage());
            }
        }else{
            echo $error['error'];
        }
    }
    
    public function import_bom_file() {        
        $username = ($this->session->userdata['logged_in']['username']);
        $ip_add = file_get_contents("http://ipecho.net/plain");
        
        $path = 'uploads/';
        require_once APPPATH . "/third_party/PHPExcel.php";
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);            
        if (!$this->upload->do_upload('uploadFile')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        if(empty($error)){
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            }else{
                $import_xls_file = 0;                    
            }
            $inputFileName = $path . $import_xls_file;           
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                //$objReader->setLoadSheetsOnly('HTP BOM');
                $objPHPExcel = $objReader->load($inputFileName);
                $results = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i=0;
                foreach ($results as $value) {
                    if($flag){
                        $flag =false;
                        continue;
                    }
                    $inser_bom[$i]['BOLEVEL'] = $value['A'];
                    $inser_bom[$i]['BOPARNT'] = $value['B'];
                    $inser_bom[$i]['BOCHILD'] = $value['C'];
                    $inser_bom[$i]['BODESC'] = $value['D'];
                    $inser_bom[$i]['BOIUM'] = $value['F'];
                    $inser_bom[$i]['BOQTY'] = $value['H'];
                    $inser_bom[$i]['BOIC'] = $value['K'];
                    $inser_bom[$i]['BOVNDNM'] = $value['R'];
                    $inser_bom[$i]['BOLLOC'] = $value['S'];
                    $inser_bom[$i]['EMP_ID'] = $username;
                    $inser_bom[$i]['IP_ADDRESS'] = $ip_add;
                    $i++;
                }
                $this->db->select('*');
                $this->db->from('tmp_bom');
                $query = $this->db->get();
                $count = $query->num_rows();
                 if($count>0){
                   $this->db->query('DELETE FROM `tmp_bom`');           
                }
                $result = $this->import_files->upload_bom($inser_bom);   
                if($result){
					$this->db->query("CALL insert_temp_bom()");
                    $data1['message']='File Imported Successfully';                      
                    $sp1 = $this->session->userdata('header');                   
                    $this->load->view($sp1);
                    $this->load->view('pages/upload_file',$data1);
                    $this->load->view('include/page_footer');
                    
                }else{
                    $data1['message']='File has been not Imported';  //                     
                    $sp1 = $this->session->userdata('header');                   
                    $this->load->view($sp1);
                    $this->load->view('pages/upload_file',$data1);
                    $this->load->view('include/page_footer');                     
                }             

            }catch (Exception $e) {
                 die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME). '": ' .$e->getMessage());
            }
        }else{
            echo $error['error'];
        }
    }
    
    public function import_stock() {
        $username = ($this->session->userdata['logged_in']['username']);
        $ip_add = file_get_contents("http://ipecho.net/plain");
        
        $path = 'uploads/';
        require_once APPPATH . "/third_party/PHPExcel.php";
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);            
        if (!$this->upload->do_upload('uploadFile')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        if(empty($error)){
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            }else{
                $import_xls_file = 0;                    
            }
            $inputFileName = $path . $import_xls_file;           
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                //$objReader->setLoadSheetsOnly('Stock file');
                $objPHPExcel = $objReader->load($inputFileName);
                $results = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i=0;
                foreach ($results as $value) {
                    if($flag){
                        $flag =false;
                        continue;
                    }
                    $inser_stock[$i]['LPROD'] = $value['F'];
                    $inser_stock[$i]['IDESC'] = $value['G'];
                    $inser_stock[$i]['ILSTOCK'] = $value['H'];
                    $inser_stock[$i]['EMP_ID'] = $username;
                    $inser_stock[$i]['IP_ADDRESS'] = $ip_add;
                    $i++;
                } 
                $this->db->select('*');
                $this->db->from('tmp_bom');
                $query = $this->db->get();
                $count = $query->num_rows();
                 if($count>0){
                   $this->db->query('DELETE FROM `tmp_bom`');           
                }
                $result = $this->import_files->upload_stock($inser_stock);   
                if($result){
					$this->db->query("CALL insert_temp_bom()");
                    $data1['message']='File Imported Successfully';                      
                    $sp1 = $this->session->userdata('header');                   
                    $this->load->view($sp1);
                    $this->load->view('pages/upload_file',$data1);
                    $this->load->view('include/page_footer'); 
                    
                }else{
                    $data1['message']='File has been not Imported';  //                     
                    $sp1 = $this->session->userdata('header');                   
                    $this->load->view($sp1);
                    $this->load->view('pages/upload_file',$data1);
                    $this->load->view('include/page_footer');                      
                }             

            }catch (Exception $e) {
                 die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME). '": ' .$e->getMessage());
            }
        }else{
            echo $error['error'];
        }
    }
    function import_location() {
        $username = ($this->session->userdata['logged_in']['username']);
        $ip_add = file_get_contents("http://ipecho.net/plain");
        
        $path = 'uploads/';
        require_once APPPATH . "/third_party/PHPExcel.php";
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);            
        if (!$this->upload->do_upload('uploadFile')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        if(empty($error)){
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            }else{
                $import_xls_file = 0;                    
            }
            $inputFileName = $path . $import_xls_file;           
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                //$objReader->setLoadSheetsOnly('Stock file');
                $objPHPExcel = $objReader->load($inputFileName);
                $results = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i=0;
                foreach ($results as $value) {
                    if($flag){
                        $flag =false;
                        continue;
                    }
                    $inser_stock[$i]['bochild'] = $value['D'];
                    $inser_stock[$i]['Trim'] = $value['E'];
                    $inser_stock[$i]['BODESC'] = $value['F'];
                    $inser_stock[$i]['WH_loc'] = $value['G'];
                    $inser_stock[$i]['line_side_2_bin'] = $value['H'];
                    $inser_stock[$i]['part_status'] = $value['I'];
                    $inser_stock[$i]['EMP_ID'] = $username;
                    $inser_stock[$i]['IP_ADDRESS'] = $ip_add;
                    $i++;
                }                
                $result = $this->import_files->upload_loation($inser_stock);   
                if($result){				
                    $data1['message']='File Imported Successfully';                      
                    $sp1 = $this->session->userdata('header');                   
                    $this->load->view($sp1);
                    $this->load->view('pages/upload_file',$data1);
                    $this->load->view('include/page_footer'); 
                    
                }else{
                    $data1['message']='File has been not Imported';  //                     
                    $sp1 = $this->session->userdata('header');                   
                    $this->load->view($sp1);
                    $this->load->view('pages/upload_file',$data1);
                    $this->load->view('include/page_footer');                      
                }             

            }catch (Exception $e) {
                 die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME). '": ' .$e->getMessage());
            }
        }else{
            echo $error['error'];
        }
    }
//    Pichart
    
    function pichart(){
       $data1 = array(
           'frozen_count'=>$this->Frozen->frozen_count(),
           'article_plan'=>$this->Frozen->article_plan(),
           'pick_article_plan'=>$this->Frozen->pick_article_plan(),
           'close_article_plan'=>$this->Frozen->close_article_plan()
       );       
      
       
        $responce->cols[] = array( 
            "id" => "", 
            "label" => "Topping", 
            "pattern" => "", 
            "type" => "string" 
        ); 
        $responce->cols[] = array( 
            "id" => "", 
            "label" => "Total", 
            "pattern" => "", 
            "type" => "number" 
        );
        //$this->db->query("CALL insert_temp_bom()");
        $ss =  json_encode($data1); 
        $sp1 = $this->session->userdata('header');                   
        $this->load->view($sp1);
        $this->load->view('pages/home_dashboard');
        $this->load->view('include/page_footer');
    }
    
    public function searchFrozen(){
        $fr = $this->input->post('frozen');
        if(!empty($fr)){
             $this->db->SELECT('kiting_plan.SEQ_NO,bom.BOLEVEL,kiting_plan.PRIORITY,bom.BOPARNT,kiting_plan.QTY,bom.BOCHILD,stock.ILSTOCK,bom.BOQTY,(kiting_plan.QTY *bom.BOQTY) as REQ_QTY,kiting_plan.FROZEN_FLAG')                       
                    ->FROM('bom,kiting_plan,stock')
                    ->WHERE("kiting_plan.ARTICLE_NO = bom.BOPARNT and bom.BOCHILD = stock.LPROD and kiting_plan.FROZEN_FLAG='$fr'")
                    ->ORDER_BY('kiting_plan.PRIORITY','ASC');        
            $query = $this->db->get();       
            $data['result'] = $query->result();            
            
        }else{
                
            $this->db->SELECT('kiting_plan.SEQ_NO,bom.BOLEVEL,kiting_plan.PRIORITY,bom.BOPARNT,kiting_plan.QTY,bom.BOCHILD,stock.ILSTOCK,bom.BOQTY,(kiting_plan.QTY *bom.BOQTY) as REQ_QTY,kiting_plan.FROZEN_FLAG')                       
                    ->FROM('bom,kiting_plan,stock')
                    ->WHERE("kiting_plan.ARTICLE_NO = bom.BOPARNT and bom.BOCHILD = stock.LPROD ")
                    ->ORDER_BY('kiting_plan.PRIORITY','ASC');        
            $query = $this->db->get();       
            $data['result'] = $query->result();   
        }   
        $this->load->helper('url');
        $sp1 = $this->session->userdata('header');                   
        $this->load->view($sp1);
        $this->load->view('pages/dashboard',$data);
        $this->load->view('include/page_footer');
    }    

}
