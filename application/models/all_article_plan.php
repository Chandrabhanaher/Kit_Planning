<?php

class all_article_plan extends CI_Model{
    function __construct() {
        parent::__construct();
         
    }   

//      Frozens Detailss    
    function make_article_details($term=''){ 
        $column = array('k.SEQ_NO',null,'k.PRIORITY',null,null,null,null,null,null,null);
        $this->db->SELECT('k.SEQ_NO,b.BOLEVEL,k.PRIORITY,b.BOPARNT,k.QTY,b.BOCHILD,s.ILSTOCK,b.BOQTY,(k.QTY * b.BOQTY) as REQ_QTY,k.FROZEN_FLAG')
                ->FROM('kiting_plan as k')
                ->JOIN('bom as b','k.ARTICLE_NO = b.BOPARNT')
                ->JOIN('stock as s','b.BOCHILD = s.LPROD')
                ->LIKE('b.BOPARNT',$term)
                ->OR_LIKE('s.LPROD', $term)
                ->OR_LIKE('k.FROZEN_FLAG', $term)
                ->ORDER_BY('k.PRIORITY');
        if(isset($_POST['order'])) // here order processing
        {
           $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
           $order = $this->order;
           $this->db->order_by(key($order), $order[key($order)]);
        }
    }  
    function make_plan(){
        $term = $_POST['search']['value']; 
        $this->make_article_details($term); 
        if($_POST["length"] != -1){  
            $this->db->limit($_POST['length'], $_POST['start']);  
        }  
        $query = $this->db->get();  
        return $query->result();
      }
    function get_all_plan(){
        $this->db->SELECT('k.SEQ_NO,b.BOLEVEL,k.PRIORITY,b.BOPARNT,k.QTY,b.BOCHILD,s.ILSTOCK,b.BOQTY,(k.QTY * b.BOQTY) as REQ_QTY,k.FROZEN_FLAG')
               ->FROM('kiting_plan as k')
               ->JOIN('bom as b','k.ARTICLE_NO = b.BOPARNT')
               ->JOIN('stock as s','b.BOCHILD = s.LPROD')
               ->ORDER_BY('k.PRIORITY');                               
        return $this->db->count_all_results();  
      }
    function get_filtered_plan(){
        $term = $_POST['search']['value']; 
        $this->make_article_details($term);        
        $query = $this->db->get();  
        return $query->num_rows(); 
    }
    function fetch_child_part($LPROD){        
        $this->db->select('*')->from('bom')->where('BOPARNT',$LPROD);  
        $query = $this->db->get();  
        return $query->result();  
//        $this->db->where("BOPARNT", $LPROD);  
//        $query = $this->db->get('bom');  
//        return $query->result();  
    } 
//    ==========================================================
    //    Close Date Report
    function report_search($term=''){
        $column = array('SEQ_NO',null,null,null,null,null,null);
        $this->db->SELECT('SEQ_NO,ARTICLE_NO,ARTICLE_DEC,QTY,SCM_Remark,IBL_Remark,A_CLOSE_DATE')
                ->FROM('kiting_plan')
                ->WHERE('A_CLOSE_FLAG', 'Y')
                ->LIKE('SEQ_NO',$term)
                ->ORDER_BY('SEQ_NO');
        
//                ->WHERE('SEQ_NO <','2019000000')
        if(isset($_POST['order'])) // here order processing
        {
           $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
           $order = $this->order;
           $this->db->order_by(key($order), $order[key($order)]);
        }        
    
    }
    function close_kit_report(){
        $term = $_POST['search']['value']; 
        $this->report_search($term); 
        if($_POST["length"] != -1){  
            $this->db->limit($_POST['length'], $_POST['start']);  
        }  
        $query = $this->db->get();  
        return $query->result();   
    }
    function get_all_closeKit_repoprt(){
        $this->db->SELECT('SEQ_NO,ARTICLE_NO,ARTICLE_DEC,QTY,SCM_Remark,IBL_Remark,A_CLOSE_DATE')
                ->FROM('kiting_plan')
                ->WHERE('A_CLOSE_FLAG', 'Y')
                ->ORDER_BY('SEQ_NO');
        return $this->db->count_all_results();
    }
    function get_filtered_record() {
        $term = $_POST['search']['value']; 
        $this->report_search($term);        
        $query = $this->db->get();  
        return $query->num_rows();         
    }
//    End Close Report ================================================
    function close_kit(){
        $this->db->SELECT(array('SEQ_NO','ARTICLE_NO','ARTICLE_DEC','QTY','SCM_Remark','IBL_Remark','A_CLOSE_DATE'))
                ->FROM('kiting_plan')
                ->WHERE('A_CLOSE_FLAG', 'Y')
                ->WHERE('SEQ_NO <','2019000000');
        $query = $this->db->get();
        return $query->result_array();
    }
    function total_bom(){
         $this->db->SELECT(array('sr_no','bo_level','bom_parent','child','bom_desc','kit_qty','bom_child_qty','vender','req_stock','total_stock','avl_stock','status','sq_no','p_id'))
                ->FROM('tmp_bom');
        $query = $this->db->get();
        return $query->result_array();
    }
   
//    ======================================================================
    function bom_level($seq,$al_plan){
        $this->db->select('*')
                ->from('tmp_bom as b')
                ->join('loc_master as l','b.child = l.bochild')
                 ->where('b.sq_no',$seq)
                ->where('b.p_id',$al_plan);                  
        $query = $this->db->get();  
        return $query->result();   
    }
    function temp_bom($data12){        
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        foreach ( $data as $inv ) {
            $custInfo = $inv->custInfo;
            $rate =     $inv->rate;
            
            $stored_procedure = "CALL insert_temp_bom(?, ?, ?)";
            $result=$this->db->query($stored_procedure,$data12);          
            if ($result !== NULL) {
                return TRUE;
            }
            return FALSE; 
        }
     //$this->db->query("CALL insert_temp_bom('2019000107','8311010163','1001')");
        
    }
    function open_plan_excel() {
        $this->db->select(array('e.SEQ_NO', 'e.ARTICLE_NO', 'e.ARTICLE_DEC','e.QTY','e.PRIORITY','e.EMP_ID','e.IP_ADDRESS','e.IMPORT_DATE'));
        $this->db->from('kiting_plan as e')
                ->where('FROZEN_FLAG',null)
                ->where('A_CLOSE_FLAG',null)
                ->where('PICK_FLAG',null);
        $query = $this->db->get();
        return $query->result_array();
    }
    function all_bom_excel() {
        $this->db->select(array('e.DOC_NO', 'e.BOLEVEL', 'e.BOPARNT','e.BOCHILD','e.BODESC','e.BOIUM','e.BOQTY','e.BOIC','e.BOVNDNM','e.EMP_ID'));
        $this->db->from('bom as e');               
        $query = $this->db->get();
        return $query->result_array();
    }
    function frozen_excel($seq) {
        $this->db->select(array('e.bo_level','e.bom_parent','e.child','e.bom_desc','e.kit_qty','e.bom_child_qty','e.req_stock','e.stock','e.avl_stock','l.WH_loc','l.line_side_2_bin','l.part_status'))
                ->from('tmp_bom as e')
                ->join('loc_master as l','e.child = l.bochild','left outer')
                ->where('sq_no',$seq)
                 ->where('bo_level','..01')
                ->order_by('WH_loc','DESC');
        $query = $this->db->get();  
        return $query->result_array();      
    }
    function frozen_plans(){
        $this->db->select(array('e.SEQ_NO', 'e.ARTICLE_NO', 'e.ARTICLE_DEC','e.QTY','e.PLAN_DATE','e.PRIORITY','e.EMP_ID','e.IP_ADDRESS','e.IMPORT_DATE'));
        $this->db->from('kiting_plan as e')
                ->where('FROZEN_FLAG','Y')
                ->where('A_CLOSE_FLAG IS NULL');
        $query = $this->db->get();
        return $query->result_array(); 
    }
}
