<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginModel
 *
 * @author ugcch
 */
class LoginModel extends CI_Model{
    //put your code here
      public function sendEmail($email) {
        $this->db->SELECT('*')
                ->FROM('USERS')
                ->WHERE("email", $email);                
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function login_hear($user,$pass){
       
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("emp_id",$user)
                ->where("password",$pass)
                ->where('frozen_sub1',1);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function login_hear1($user,$pass){
       
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("emp_id",$user)
                ->where("password",$pass)
                ->where('frozen_sub',1);
         $query = $this->db->get();
        return $query->num_rows();
    }
    public function login_hear2($user,$pass){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("emp_id",$user)
                ->where("password",$pass)
                ->where('frozen_m',1)
                ->where('upload_plan_stock',1);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function login_hear3($user,$pass){
       
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("emp_id",$user)
                ->where("password",$pass)
                ->where('frozen_m',1)
                ->where('upload_m',1);       
        $query = $this->db->get();
        return $query->num_rows();

    }
    
    public function read_user_information($username){
        $condition = "emp_id =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
}
