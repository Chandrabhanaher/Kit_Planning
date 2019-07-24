<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Export_Reports extends CI_Controller {
    function __construct() {
            parent::__construct();
            $this->load->database(); 
            $this->load->helper('form','url');
            $this->load->model('all_article_plan');  
            $this->load->library('Pdf_Library');
    }
    public function createXLS(){    
        $this->load->library('Excel');
        //$objPHPExcel = new PHPExcel();
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Open Articles Report');
//       Set column Destination 
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        
//        column title css
        $this->excel->getActiveSheet()->getStyle("A1:I1")->applyFromArray(array("font" => array("bold" => true)));
        
//        Set column title Nmae
        $this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Sequence No');
        $this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'Article Plan');
        $this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'Article Desc.');
        $this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'Qty');
        $this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'Priority');
        $this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'Import Emp.ID.');
        $this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'IP Address');
        $this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'Import Date');
        $this->excel->setActiveSheetIndex(0)->setCellValue('I1', 'Exp. USER ID');
        
        $this->load->model('all_article_plan');
        $username = ($this->session->userdata['logged_in']['username']); 
        $data=$this->all_article_plan->open_plan_excel();
        
        $n = 2;
        
        if(!empty($data)){
            foreach ($data as $row) {
                
                $this->excel->getActiveSheet()->setCellValue('A'.$n, $row['SEQ_NO']);
                $this->excel->getActiveSheet()->setCellValue('B'.$n, $row['ARTICLE_NO']);
                $this->excel->getActiveSheet()->setCellValue('C'.$n, $row['ARTICLE_DEC']);
                $this->excel->getActiveSheet()->setCellValue('D'.$n, $row['QTY']);
                $this->excel->getActiveSheet()->setCellValue('E'.$n, $row['PRIORITY']);
                $this->excel->getActiveSheet()->setCellValue('F'.$n, $row['EMP_ID']);
                $this->excel->getActiveSheet()->setCellValue('G'.$n, $row['IP_ADDRESS']);
                $this->excel->getActiveSheet()->setCellValue('H'.$n, $row['IMPORT_DATE']);
                $this->excel->getActiveSheet()->setCellValue('I'.$n, $username);
                
                $n++;
            }
            
        }        
        $fileName ='Open Article Plan: '.date('d/m/Y').'.xls'; //save our workbook as this file name    
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$fileName.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');    
   }  
   public function createXLS1(){    
        $this->load->library('Excel');
        //$objPHPExcel = new PHPExcel();
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('BOM Report');
//       Set column Destination 
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        
//        column title css
        $this->excel->getActiveSheet()->getStyle("A1:K1")->applyFromArray(array("font" => array("bold" => true)));
        
//        Set column title Nmae
        $this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Sr.No');
        $this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'BOM Level');
        $this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'BOM Parent');
        $this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'BOM Child');
        $this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'BOM DESC');
        $this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'BOIUM');
        $this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'BOM QTY.');
        $this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'BOIC');
        $this->excel->setActiveSheetIndex(0)->setCellValue('I1', 'BOVNDNM');
        $this->excel->setActiveSheetIndex(0)->setCellValue('J1', 'Import Emp.ID.');
        $this->excel->setActiveSheetIndex(0)->setCellValue('K1', 'Exp. USER ID');
        
        
        $this->load->model('all_article_plan');
        $username = ($this->session->userdata['logged_in']['username']);
        $data=$this->all_article_plan->all_bom_excel();
        
        $n = 2;
        
        if(!empty($data)){
            foreach ($data as $row) {
                
                $this->excel->getActiveSheet()->setCellValue('A'.$n, $row['DOC_NO']);
                $this->excel->getActiveSheet()->setCellValue('B'.$n, $row['BOLEVEL']);
                $this->excel->getActiveSheet()->setCellValue('C'.$n, $row['BOPARNT']);
                $this->excel->getActiveSheet()->setCellValue('D'.$n, $row['BOCHILD']);
                $this->excel->getActiveSheet()->setCellValue('E'.$n, $row['BODESC']);
                $this->excel->getActiveSheet()->setCellValue('F'.$n, $row['BOIUM']);
                $this->excel->getActiveSheet()->setCellValue('G'.$n, $row['BOQTY']);
                $this->excel->getActiveSheet()->setCellValue('H'.$n, $row['BOIC']);
                $this->excel->getActiveSheet()->setCellValue('I'.$n, $row['BOVNDNM']);
                $this->excel->getActiveSheet()->setCellValue('J'.$n, $row['EMP_ID']);  
                $this->excel->getActiveSheet()->setCellValue('K'.$n, $username); 
                
                $n++;
            }
            
        }        
        $fileName ='Open Article Plan: '.date('d/m/Y').'.xls'; //save our workbook as this file name    
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$fileName.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');         
   } 
    public function export_fr(){  
        $this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Kit Report');
//       Set column Destination 
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        
        $this->excel->getActiveSheet()->getStyle("A1:O1")->applyFromArray(array("font" => array("bold" => true)));
        
//        Set column title Nmae
        $this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'BOM Level');
        $this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'BOM Parent');
        $this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'BOM Child');
        $this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'BOM DESC');
        $this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'PLan QTY');
        $this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'BOM QTY');
        $this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'REQ. Qty');
        $this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'Stock');
        $this->excel->setActiveSheetIndex(0)->setCellValue('I1', 'Virtual Stock');
        $this->excel->setActiveSheetIndex(0)->setCellValue('J1', 'WH Location');
        $this->excel->setActiveSheetIndex(0)->setCellValue('K1', '2 Bin');
        $this->excel->setActiveSheetIndex(0)->setCellValue('L1', 'Part Status');
        $this->excel->setActiveSheetIndex(0)->setCellValue('M1', 'Remark 1');
        $this->excel->setActiveSheetIndex(0)->setCellValue('N1', 'Remark 2');
        $this->excel->setActiveSheetIndex(0)->setCellValue('O1', 'Exp.USER ID');
        
        $seq = $this->uri->segment(2);
        $username = ($this->session->userdata['logged_in']['username']); 
        $result = $this->all_article_plan->frozen_excel($seq);
        $n = 2;
         if(!empty($result)){
            foreach ($result as $row) {
                
                $this->excel->getActiveSheet()->setCellValue('A'.$n, $row['bo_level']);
                $this->excel->getActiveSheet()->setCellValue('B'.$n, $row['bom_parent']);
                $this->excel->getActiveSheet()->setCellValue('C'.$n, $row['child']);
                $this->excel->getActiveSheet()->setCellValue('D'.$n, $row['bom_desc']);
                $this->excel->getActiveSheet()->setCellValue('E'.$n, $row['kit_qty']);
                $this->excel->getActiveSheet()->setCellValue('F'.$n, $row['bom_child_qty']);
                $this->excel->getActiveSheet()->setCellValue('G'.$n, $row['req_stock']);
                $this->excel->getActiveSheet()->setCellValue('H'.$n, $row['stock']);
                $this->excel->getActiveSheet()->setCellValue('I'.$n, $row['avl_stock']);  
                $this->excel->getActiveSheet()->setCellValue('J'.$n, $row['WH_loc']); 
                $this->excel->getActiveSheet()->setCellValue('K'.$n, $row['line_side_2_bin']); 
                $this->excel->getActiveSheet()->setCellValue('L'.$n, $row['part_status']); 
                $this->excel->getActiveSheet()->setCellValue('O'.$n, $username);
                
                $n++;
            }
            
        }
       
        $fileName1 = 'Frozen Report : '.date('d/m/Y').'.xls'; //save our workbook as this file name    
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$fileName1.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
        echo '<script>alert('.$seq.');</script>';    
        redirect('Alls_Fronens','refresh');
   }
   
//   Only frozen list
    function only_frozen(){
        $this->load->library('Excel');
        //$objPHPExcel = new PHPExcel();
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Frozen Plan Report');
//       Set column Destination 
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        
//        column title css
        $this->excel->getActiveSheet()->getStyle("A1:J1")->applyFromArray(array("font" => array("bold" => true)));
        
//        Set column title Nmae
        $this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Sequence No');
        $this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'Article Plan');
        $this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'Article Desc.');
        $this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'Qty');
        $this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'Plan Date');
        $this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'Priority');
        $this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'Import Emp.ID.');
        $this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'IP Address');
        $this->excel->setActiveSheetIndex(0)->setCellValue('I1', 'Import Date');
        $this->excel->setActiveSheetIndex(0)->setCellValue('J1', 'Exp.USER ID');
        
        $this->load->model('all_article_plan');
        $username = ($this->session->userdata['logged_in']['username']); 
        $data=$this->all_article_plan->frozen_plans();
        
        $n = 2;
        
        if(!empty($data)){
            foreach ($data as $row) {
                
                $this->excel->getActiveSheet()->setCellValue('A'.$n, $row['SEQ_NO']);
                $this->excel->getActiveSheet()->setCellValue('B'.$n, $row['ARTICLE_NO']);
                $this->excel->getActiveSheet()->setCellValue('C'.$n, $row['ARTICLE_DEC']);
                $this->excel->getActiveSheet()->setCellValue('D'.$n, $row['QTY']);
                $this->excel->getActiveSheet()->setCellValue('E'.$n, $row['PLAN_DATE']);
                $this->excel->getActiveSheet()->setCellValue('F'.$n, $row['PRIORITY']);
                $this->excel->getActiveSheet()->setCellValue('G'.$n, $row['EMP_ID']);
                $this->excel->getActiveSheet()->setCellValue('H'.$n, $row['IP_ADDRESS']);
                $this->excel->getActiveSheet()->setCellValue('I'.$n, $row['IMPORT_DATE']);
                $this->excel->getActiveSheet()->setCellValue('J'.$n, $username);
                $n++;
            }
            
        }        
        $fileName ='Frozen Plan: '.date('d/m/Y').'.xls'; //save our workbook as this file name    
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$fileName.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output'); 
    }
//    Close Date Report
    function close_report() {
        $this->load->library('Excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Close Kit Report');
        
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        
        $this->excel->getActiveSheet()->getStyle("A1:H1")->applyFromArray(array("font" => array("bold" => true)));
        
        $this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Sequence No');
        $this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'Article Plan');
        $this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'Article Desc.');
        $this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'Qty');
        $this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'SCM Remark');
        $this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'IBL Remark');
        $this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'Close Date');
        $this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'Exp.USER ID');
        
       $this->load->model('all_article_plan');
       $username = ($this->session->userdata['logged_in']['username']); 
       $data=$this->all_article_plan->close_kit();
       $n = 2;        
        if(!empty($data)){
            foreach ($data as $row) {
                
                $this->excel->getActiveSheet()->setCellValue('A'.$n, $row['SEQ_NO']);
                $this->excel->getActiveSheet()->setCellValue('B'.$n, $row['ARTICLE_NO']);
                $this->excel->getActiveSheet()->setCellValue('C'.$n, $row['ARTICLE_DEC']);
                $this->excel->getActiveSheet()->setCellValue('D'.$n, $row['QTY']);
                $this->excel->getActiveSheet()->setCellValue('E'.$n, $row['SCM_Remark']);
                $this->excel->getActiveSheet()->setCellValue('F'.$n, $row['IBL_Remark']);
                $this->excel->getActiveSheet()->setCellValue('G'.$n, $row['A_CLOSE_DATE']);
                $this->excel->getActiveSheet()->setCellValue('H'.$n, $username);
                $n++;
            }            
        }        
        $fileName ='Close Kits: '.date('d/m/Y').'.xls'; //save our workbook as this file name    
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$fileName.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');      
        $objWriter->save('php://output'); 
    }
    
    function temp_bom_excel(){
         $this->load->library('Excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('BOM');
          $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
//        column title css
        $this->excel->getActiveSheet()->getStyle("A1:O1")->applyFromArray(array("font" => array("bold" => true)));
        
//        Set column title Nmae
        $this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Serial No');
        $this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'BOM Level');
        $this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'BOM Parent.');
        $this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'BOM Child');
        $this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'BOM DES');
        $this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'Plan Qty');
        $this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'BOM Child Qty');
        $this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'Vender');
        $this->excel->setActiveSheetIndex(0)->setCellValue('I1', 'Request Stosk');
        $this->excel->setActiveSheetIndex(0)->setCellValue('J1', 'TotalStock');
        $this->excel->setActiveSheetIndex(0)->setCellValue('K1', 'Available Stock');
        $this->excel->setActiveSheetIndex(0)->setCellValue('L1', 'Status');
        $this->excel->setActiveSheetIndex(0)->setCellValue('M1', 'Sequence No');
        $this->excel->setActiveSheetIndex(0)->setCellValue('N1', 'Artical Plam');
        $this->excel->setActiveSheetIndex(0)->setCellValue('O1', 'Exp.USER ID');
        $this->load->model('all_article_plan');
       $username = ($this->session->userdata['logged_in']['username']); 
       $data=$this->all_article_plan->total_bom();
       $n = 2;        
        if(!empty($data)){
            foreach ($data as $row) {
                
                $this->excel->getActiveSheet()->setCellValue('A'.$n, $row['sr_no']);
                $this->excel->getActiveSheet()->setCellValue('B'.$n, $row['bo_level']);
                $this->excel->getActiveSheet()->setCellValue('C'.$n, $row['bom_parent']);
                $this->excel->getActiveSheet()->setCellValue('D'.$n, $row['child']);
                $this->excel->getActiveSheet()->setCellValue('E'.$n, $row['bom_desc']);
                $this->excel->getActiveSheet()->setCellValue('F'.$n, $row['kit_qty']);
                $this->excel->getActiveSheet()->setCellValue('G'.$n, $row['bom_child_qty']);
                $this->excel->getActiveSheet()->setCellValue('H'.$n, $row['vender']);
                $this->excel->getActiveSheet()->setCellValue('I'.$n, $row['req_stock']);
                $this->excel->getActiveSheet()->setCellValue('J'.$n, $row['total_stock']);
                $this->excel->getActiveSheet()->setCellValue('K'.$n, $row['avl_stock']);
                $this->excel->getActiveSheet()->setCellValue('L'.$n, $row['status']);
                $this->excel->getActiveSheet()->setCellValue('M'.$n, $row['sq_no']);
                $this->excel->getActiveSheet()->setCellValue('N'.$n, $row['p_id']);
                $this->excel->getActiveSheet()->setCellValue('O'.$n, $username);
                $n++;
            }            
        }        
        $fileName ='Total BOM: '.date('d/m/Y').'.xls'; //save our workbook as this file name    
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$fileName.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');      
        $objWriter->save('php://output'); 
    }
    
//    Pdf Print
    
    function frozen_print() {
        $seq = $this->uri->segment(2);
        
        $this->db->select('*')
                ->from('tmp_bom as t')
                ->join('loc_master as l','t.child = l.bochild','left outer')
                ->where('sq_no',$seq)
                ->where('bo_level','..01')
                ->order_by('WH_loc','DESC');
        $query = $this->db->get();  
        $data['records'] = $query->result(); 
        
        $this->db->select('*')
                    ->from('kiting_plan')
                    ->where('SEQ_NO',$seq);
        $query1 = $this->db->get(); 
        $data['records1'] = $query1->result(); 
        
        $this->load->view('pages/plan_report',$data);
    }
}

