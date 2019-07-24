<?php

class Import_Ex_Files extends CI_Model{
    
    public function upload_file($kit_plan){
//        $this->db->select('*')
//                ->from('kiting_plan');
//         $query = $this->db->get();
//         $count = $query->num_rows();
//         if($count>0){
//             $this->db->query('DELETE FROM `kiting_plan`');  
//        }
        $res = $this->db->insert_batch('kiting_plan',$kit_plan);
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function upload_bom($inser_bom) {
//        $this->db->select('*')
//                ->from('bom');
//         $query = $this->db->get();
//         $count = $query->num_rows();
//         if($count>0){
//             $this->db->query('DELETE FROM `bom`');  
//         }
        $res = $this->db->insert_batch('bom',$inser_bom);
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function upload_stock($inser_stock) {
        $this->db->select('*')
                ->from('stock');
         $query = $this->db->get();
         $count = $query->num_rows();
         if($count>0){
             $this->db->query('DELETE FROM `stock`');  
         }
        $res = $this->db->insert_batch('stock',$inser_stock);
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function upload_loation($inser_stock) { 
        $this->db->select('*');
        $this->db->from('loc_master');
        $query = $this->db->get();
        $count = $query->num_rows();
        if($count>0){
            $this->db->query("DELETE FROM loc_master");           
        }
        $res = $this->db->insert_batch('loc_master',$inser_stock);
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function plan_last_upload(){
        $this->db->select('max(IMPORT_DATE) as dates')
               	->from('kiting_plan');
        $query = $this->db->get();
        return $query->result();
    }
    public function bom_last_upload(){
        $this->db->select('max(IMPORT_DATE) as dates')
                   ->from('bom');
        $query = $this->db->get();
        return $query->result();
    }
    public function stock_last_upload(){
            $this->db->select('max(IMPORT_DATE) as dates')
                ->from('stock');
            $query = $this->db->get();
            return $query->result();
    }
    public function loc() {
        $this->db->select('max(import_date) as dates')
               ->from('loc_master');
        $query = $this->db->get();
        return $query->result();
    }
        
}
