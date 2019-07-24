<?php


class Frozen extends CI_Model{
     public function __construct() {
        parent::__construct();
        
    }
    public function kiiting_Details() {
        $this->db->SELECT('SEQ_NO,ARTICLE_NO,QTY,PRIORITY,PLAN_DATE,ARTICLE_DEC')
               ->FROM('kiting_plan');
        $query = $this->db->get(); 
        return $query->result();
    }
    public function frozen_Details() {
        $this->db->SELECT('SEQ_NO,ARTICLE_NO,QTY,PRIORITY,PLAN_DATE,ARTICLE_DEC,FROZEN_FLAG,PICK_DATE')
               ->FROM('kiting_plan');
        $this->db->WHERE('FROZEN_FLAG','Y')
                ->WHERE('A_CLOSE_FLAG IS NULL');
        $query1 = $this->db->get(); 
        return $query1->result();
    }
    public function updateFrozen_Flag($data,$ids) {     
         
         $this->db->set($data);                  
         $this->db->where_in("SEQ_NO", $ids); 
         $this->db->update("kiting_plan"); 
    }
    public function updatePick_Flag($data1,$flag) {
         $this->db->set($data1);                  
         $this->db->where_in("SEQ_NO", $flag); 
         $this->db->update("kiting_plan"); 
    }
    public function close_frosen($data11,$fr) {
        $this->db->set($data1);                  
        $this->db->where_in("SEQ_NO", $fr); 
        $this->db->update("kiting_plan"); 
    }
    
    function frozen_count() {	
        $this->db->select('*')->from('kiting_plan')->where('FROZEN_FLAG','Y');
        return $num_rows = $this->db->count_all_results();
    }
    function article_plan(){
        $this->db->select('*')->from('kiting_plan');
        return $num_rows = $this->db->count_all_results();
    }
    function pick_article_plan(){
        $this->db->select('*')->from('kiting_plan')->where('PICK_FLAG','Y');
        return $num_rows = $this->db->count_all_results();
    }
    function close_article_plan(){
        $this->db->select('*')->from('kiting_plan')->where('A_CLOSE_FLAG','Y');
        return $num_rows = $this->db->count_all_results();
    }
   
}
