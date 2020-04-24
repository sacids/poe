<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 01/04/2020
 * Time: 11:43
 */

class Manage extends MX_Controller{
    
    private $data;

    public function __construct(){
        parent::__construct();
        $this->load->model('model');
        $this->load->library('db_exp');

    }

    private function manage_tbl($tbl){

        $post = $this->input->post() + $this->input->get();
        $method_name    = 'manage_'.$tbl;
        if(array_key_exists('action',$post) && $post['action'] == 'edit' && method_exists ( $this, $method_name )){
            $this->{$method_name}($post);
            return true;
        }else{
            return false;
        }
    }

    private function make_tabs($tabs,$row){
        $data['tabs']   = $tabs;
        $data['row']    = $row;

        $this->load->view('tabs',$data);
    }

    public function index(){

        echo 'please select a module';
    }

    public function modules(){

        if($this->manage_tbl('modules')) return;

        $data['title']      = 'Module Management';
        $data['description']    = 'Setup modules and corresponding methods for use within the system';
        $this->load->view('admin/common/title',$data);

        $this->db_exp->set_table('modules');
        $this->db_exp->render('row_list');
        $output['output']   = $this->db_exp->output;
        $this->load->view('admin/db_exp/render',$output);

    }

    public function users(){


        if($this->manage_tbl('users')) return;

        $data['title']      = 'User Management';
        $data['description']    = 'Add users, delete users, set passwords and permissions';
        $this->load->view('admin/common/title',$data);

        $this->db_exp->set_table('users');
        $this->db_exp->set_hidden(
            array(
                'ip_address','salt','sex','activation_code','forgotten_password_code',
                'forgotten_password_time','password',
                'remember_code','created_on','last_login',
                'active'
            )
        );

        $this->db_exp->render('row_list');
        $output['output']   = $this->db_exp->output;
        $this->load->view('admin/db_exp/render',$output);
    }

    public function edit_modules(){
        $this->db_exp->set_table('modules');
        $this->db_exp->render('edit');
        $output['output']   = $this->db_exp->output;
        $this->load->view('admin/db_exp/render',$output);
    }
    public function module_links(){
        
        $this->db_exp->set_table('module_links');
        $this->db_exp->set_hidden('module_id',$this->input->post('id'));
        $this->db_exp->render('row_list');
        $output['output']   = $this->db_exp->output;
        $this->load->view('admin/db_exp/render',$output);

    }

    public function manage_users($args){

        $this->model->set_table('users');
        $row            = $this->model->as_array()->get($args['id']);
        $row['_title']  = 'Manage '.$row['first_name'].' '.$row['last_name'];

        $tabs   = array();
        $tmp    = array(
            'label'     => 'Edit',
            'method'    => 'manage/edit_user',
            'render'    => 'edit',
            'args'      => 'id='.$row['id'],
        );
        array_push($tabs,$tmp);
        $tmp    = array(
            'label'     => 'Change Password',
            'method'    => 'auth/set_password/'.$row['id'],
            'render'    => 'list',
            'args'      => '',
        );
        array_push($tabs,$tmp);
        $tmp    = array(
            'label'     => 'Groups',
            'method'    => 'manage/user_groups',
            'render'    => 'list',
            'args'      => 'user_id='.$row['id'],
        );
        array_push($tabs,$tmp);

        $this->make_tabs($tabs,$row);
    }
    public function edit_user(){

        $this->db_exp->set_table('users');
        $this->db_exp->set_pri_id($this->input->post('id'));
        $this->db_exp->set_hidden(
            array(
                'ip_address','salt','sex','activation_code','forgotten_password_code',
                'forgotten_password_time','password',
                'remember_code','created_on','last_login',
                'active'
            )
        );
        $this->db_exp->render('edit');
        echo $this->db_exp->output;
        //echo '<div class="dbx_wrapper" id="'.uniqid().'">'.$this->db_exp->output.'</div><script> make_table(); </script>';
    }

    public function user_groups(){

        //print_r($this->input->post());
        $this->db_exp->set_table('users_groups');
        $this->db_exp->set_db_select('group_id','groups','id','name');
        $this->db_exp->set_search_condition('user_id = "'.$this->input->post('id').'"');
        $this->db_exp->render('row_list');
        //echo $this->db_exp->output;
        $output['output']   = $this->db_exp->output;
        $this->load->view('admin/db_exp/render',$output);
    }


    public function manage_modules($args){

        $this->model->set_table('modules');
        $row            = $this->model->as_array()->get($args['id']);
        $row['_title']  = 'Manage Modules';

        $tabs   = array();
        $tmp    = array(
            'label'     => 'Edit',
            'method'    => 'manage/edit_modules',
            'render'    => 'edit',
            'args'      => 'id='.$row['id'],
        );
        array_push($tabs,$tmp);
        $tmp    = array(
            'label'     => 'Methods',
            'method'    => 'manage/module_links',
            'render'    => 'list',
            'args'      => 'module_id='.$row['id'],
        );
        array_push($tabs,$tmp);

        $this->make_tabs($tabs,$row);
    }
}