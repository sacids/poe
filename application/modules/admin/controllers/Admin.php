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
        $this->load->library('db_exp');

    }

    public function dashboard(){
        $this->load->view('main');
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

        //international
        $this->data['international'] = $this->entry_model->count_many_by(['form_type' => 'INTERNATIONAL']);
        $this->data['domestic'] = $this->entry_model->count_many_by(['form_type' => 'DOMESTIC']);

        
        //echo '<pre>'; print_r($data); echo '</pre>';exit();
        $this->load->view('common/head', $this->data);
        $this->load->view('common/sidebar',$data);
        $this->load->view('common/header');
        $this->load->view('main');
        $this->load->view('common/footer');
        $this->load->view('common/foot');
    }

    public function edit_field(){

        $get    = $this->input->get();
        $table  = base64_decode($get['t']);
        $id     = $get['i'];
        $val    = $get['v'];
        $fld    = $get['f'];

        $this->model->set_table($table);
        if($this->model->update($id,array($fld => $val))){
            log_message('DEBUG','ADMIN : edit_field : success : '.json_encode($get));
            echo 1;
        }else{
            log_message('DEBUG','ADMIN : edit_field : failed : '.json_encode($get));
            echo 0;
        }
    }

    public function modules(){

        $this->db_exp->set_table('modules');
        $this->db_exp->render('row_list');
        echo '<div class="dbx_wrapper" id="'.uniqid().'">'.$this->db_exp->output.'</div>';

    }


    public function dashboard1(){

        $this->module->set_table('entries');
        //$where  = 

    }


}