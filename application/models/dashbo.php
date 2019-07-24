<?php
class dashbo extends CI_Model {
        function __construct() {
            parent::__Construct();
            $this->db = $this->load->database('default', TRUE, TRUE);
        }

        function getdata(){
            $this->db->select('*');
            $query = $this->db->get('kiting_plan');
            return $query->result_array();

        }

        function getdata_article_plan(){
           $sql ="CALL `plan_cout`()";
           $query=$this->db->query($sql);
             return ($query->result());

        }
    
        function getdata_pie_chart(){
        $sql ="SELECT count(`PICK_FLAG`) as count,'Pick Article ' as name FROM kiting_plan WHERE PICK_FLAG IS NOT NULL AND A_CLOSE_FLAG IS NULL UNION ALL SELECT count(`A_CLOSE_FLAG`),'Article Close'as name FROM kiting_plan UNION ALL SELECT count(`FROZEN_FLAG`),'Frozen' FROM kiting_plan where A_CLOSE_FLAG IS NULL UNION ALL SELECT count(`ARTICLE_NO`),'Article Plan' FROM kiting_plan WHERE FROZEN_FLAG IS NULL AND A_CLOSE_FLAG IS NULL";
        $query=$this->db->query($sql);
        return $query->result_array();
        }
}