<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Charts extends CI_Controller {
    function __Construct() {
        parent::__Construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('dashbo');
    }
    
    public function index()
    {
        $this->load->view('chartView');
    }
    
    function getdata(){
        $data  = $this->dashbo->getdata();
        print_r(json_encode($data, true));
    }
    
    function getdata_pie_chart(){
        $data  = $this->dashbo->getdata_pie_chart();
        print_r(json_encode($data, true));
    }
    
    function getdata_article_plan(){
        $data= $this->dashbo->getdata_article_plan();  
        print_r(json_encode($data, true));
    }
}