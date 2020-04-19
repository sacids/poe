<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 01/04/2020
 * Time: 11:43
 */

class Admin extends MX_Controller{
    
    private $data;

    public function __construct(){
        parent::__construct();
        $this->load->model('model');

    }

    public function index(){

        $this->model->set_table('modules');
        $results  = $this->model->get_all();
        $this->model->set_table('module_links');
        $holder   = array();
        foreach($results as $result){
            $holder[$result->id]['props']   = $result;
            $holder[$result->id]['link']   = $result->link;
            if(!$result->link){
                $links = $this->model->get_many_by('module_id',$result->id);
                $holder[$result->id]['link']  = $links;
            }
        }

        $data['modules']    = $holder;
        
        //echo '<pre>'; print_r($data); echo '</pre>';exit();
        $this->load->view('common/head');
        $this->load->view('common/sidebar',$data);
        $this->load->view('common/header');
        $this->load->view('main');
        $this->load->view('common/footer');
        $this->load->view('common/foot');
    }

    public function test(){

        echo 'this is a test';
    }




}