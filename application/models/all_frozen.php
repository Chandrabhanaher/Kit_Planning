<?php

class All_Frozen extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    var $table = "kiting_plan";  
    var $select_column = array("SEQ_NO", "ARTICLE_NO", "QTY", "PRIORITY","PLAN_DATE","ARTICLE_DEC");
    var $select_column1 = array("SEQ_NO","ARTICLE_NO","QTY","PRIORITY","PLAN_DATE","ARTICLE_DEC","FROZEN_DATE");
    var $order_column = array("SEQ_NO", "ARTICLE_NO", null, null, null, null);
    
    function make_query($term=''){  
            $order_column = array("SEQ_NO", "ARTICLE_NO", null, null, null, null);
            $this->db->select('*,color_status(ARTICLE_NO) as colorsss');
            $this->db->from('kiting_plan')                   
                ->where('FROZEN_FLAG',null)
                ->where('A_CLOSE_FLAG',null)
                ->where('PICK_FLAG',null)
                ->like('ARTICLE_NO', $term)               
                ->order_by('SEQ_NO');
           if(isset($_POST["order"])){  
                 $this->db->order_by($order_column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);  
           }else if(isset($this->order)){
               $order = $this->order;
               $this->db->order_by(key($order), $order[key($order)]);
           }  
      }
    function make_datatables(){
        $term = $_POST['search']['value']; 
        $this->make_query($term);

        if($_POST["length"] != -1){  
            $this->db->limit($_POST['length'], $_POST['start']);  
        }  
        $query = $this->db->get();  
        return $query->result();  
    }
    
    function make_datatables1(){
        $term = $_POST['search']['value']; 
        $this->make_query($term);

        if($_POST["length"] != -1){  
            $this->db->limit($_POST['length'], $_POST['start']);  
        }  
        $query = $this->db->get();  
        return $query->result();  
    }
    function get_filtered_data(){  
        $term = $_POST['search']['value']; 
        $this->make_query($term);    
        $query = $this->db->get();  
        return $query->num_rows();  
      }
    
    function get_all_data(){  
        
        $this->db->select('*,color_status(ARTICLE_NO) as colorsss');
            $this->db->from('kiting_plan')
                ->where('FROZEN_FLAG',null)
                ->where('A_CLOSE_FLAG',null)
                ->where('PICK_FLAG',null)
                ->order_by('SEQ_NO');        
        return $this->db->count_all_results();  
    } 
    function updateFrozen_Flag($data1){
        $stored_procedure = "CALL frozen(?,?,?,?,?)";
        $result=$this->db->query($stored_procedure,$data1);          
        if ($result !== NULL) {
                return TRUE;
        }
        return FALSE; 
    }
//      Frozens Detailss    
    function make_frozen_details($term=''){  
            $order_column = array("SEQ_NO", "ARTICLE_NO", null, null, null, null);
            $this->db->select('*,color_status(ARTICLE_NO) as colorsss');  
            $this->db->from($this->table);
            $this->db->where('FROZEN_FLAG','Y');
            $this->db->where('A_CLOSE_FLAG IS NULL')                      
                   ->like("ARTICLE_NO", $term)  
                   ->order_by('FROZEN_DATE','ASC');
            if(isset($_POST["order"])){  
                 $this->db->order_by($order_column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);  
            }else if(isset($this->order)){
               $order = $this->order;
               $this->db->order_by(key($order), $order[key($order)]);
            }
      }  
    function make_frozen(){
        $term = $_POST['search']['value']; 
        $this->make_frozen_details($term);        
        
        if($_POST["length"] != -1){  
            $this->db->limit($_POST['length'],$_POST['start']);  
        }  
        $query = $this->db->get();  
        return $query->result();
      }
      function make_frozen1(){
        $term = $_POST['search']['value']; 
        $this->make_frozen_details($term);        
        
        if($_POST["length"] != -1){  
            $this->db->limit($_POST['length'],$_POST['start']);  
        }  
        $query = $this->db->get();  
        return $query->result();
      }
    function get_all_frozen(){
        $this->db->select("*");  
        $this->db->from($this->table)
                ->where('FROZEN_FLAG','Y')
                ->where('A_CLOSE_FLAG IS NULL')
                ->order_by('FROZEN_DATE','ASC');                
        return $this->db->count_all_results();  
      }
    function get_filtered_frozen(){
        $term = $_POST['search']['value'];
        $this->make_frozen_details($term);        
        $query = $this->db->get();  
        return $query->num_rows(); 
      }
//      Same as update frozen floag
    function pickFrozen_Flag($data1,$SEQ_NO){
        $this->db->set($data1);                  
        $this->db->where("SEQ_NO",$SEQ_NO); 
        $this->db->update($this->table);
    }
    function closeFrozen_Flag($data1,$SEQ_NO){
        $this->db->set($data1);                  
        $this->db->where("SEQ_NO",$SEQ_NO); 
        $this->db->update($this->table);
    }
    function count_plan(){
        $this->db->select('*');
        $this->db->from($this->table)
                ->where('FROZEN_FLAG IS NULL')
                ->where('A_CLOSE_FLAG IS NULL')
                ->where('PICK_FLAG IS NULL');
        $query = $this->db->get();
        return $query->num_rows();
    }
    function frozen_items(){
        $this->db->select('*');
        $this->db->from($this->table)
                ->where('FROZEN_FLAG','Y')                
                ->where('A_CLOSE_FLAG IS NULL');
        $query = $this->db->get();
        return $query->num_rows();
    }
    function pick_article_plan(){
        $this->db->select('*');
        $this->db->from($this->table)
                ->where('PICK_FLAG','Y')
                ->where('A_CLOSE_FLAG IS NULL');
        $query = $this->db->get();
        return $query->num_rows();
    }
    function close_article(){
        $this->db->select('*');
        $this->db->from($this->table)
                ->where('A_CLOSE_FLAG','Y');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    function frist_level($seq,$al_plan){
       $this->db->select('b.DOC_NO,b.BOLEVEL,b.BOPARNT,s.LPROD,b.BODESC,b.BOQTY,(k.QTY * b.BOQTY) as REQ_QTY,SUM(s.ILSTOCK) AS ILSTOCK')
                ->from('kiting_plan as k')
                ->join('bom as b','k.ARTICLE_NO = b.BOPARNT')
                ->join('stock as s','b.BOCHILD = s.LPROD')
                ->where('k.SEQ_NO',$seq)
                ->where('b.BOPARNT',$al_plan)
               ->group_by('b.DOC_NO,b.BOLEVEL,b.BOPARNT,s.LPROD,b.BOQTY');                  
        $query = $this->db->get();  
        return $query->result();   
    }
    function second_level($boparnt,$boChild){
        $this->db->select('b.DOC_NO,b.BOLEVEL,b.BOPARNT,b.BOCHILD,b.BODESC,sum(b.BOQTY) as BOQTY, sum(distinct s.ILSTOCK) as ILSTOCK')
                ->from('bom as b')
                ->join('stock as s','b.BOCHILD = s.LPROD')
                ->where('b.BOPARNT',$boChild)
                ->group_by('b.BOLEVEL,b.BOPARNT,b.BOCHILD');              
       $query = $this->db->get();
       return $query->result();  
    }
    function third_level($third_level){
         $this->db->select('b.DOC_NO,b.BOLEVEL,b.BOPARNT,b.BOCHILD,b.BODESC,sum(b.BOQTY) as BOQTY, sum(distinct s.ILSTOCK) as ILSTOCK')
                ->from('bom as b')
                ->join('stock as s','b.BOCHILD = s.LPROD')
                ->where('b.BOPARNT',$third_level)
                ->group_by('b.BOLEVEL,b.BOPARNT,b.BOCHILD');              
       $query = $this->db->get();
       return $query->result();
    }
    function insertPickLog($data2) {
        if ($this->db->insert("log", $data2)) { 
            return true; 
        } 
    }
}
