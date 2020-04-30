<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 01/04/2020
 * Time: 11:20
 */

class Db_exp extends CI_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model');
    }


    function eip(){
        
        $post   = $this->input->post();
        $id     = $post['i']; 
        $tbl    = base64_decode($post['t']);

        unset($post['i']);
        unset($post['t']);

        $this->model->set_table($tbl);
        if($this->model->update($id,$post)){
            $post['status'] = 1;
            $post['i']      = $id;
        }else{
            $post['status'] = 0;
        }

        log_message('DEBUG',json_encode($post));
        echo json_encode($post);
    }
}