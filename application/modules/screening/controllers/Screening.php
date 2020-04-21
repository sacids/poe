<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 01/04/2020
 * Time: 11:43
 */

class Screening extends MX_Controller{
    
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

    public function domestic(){

        if($this->manage_tbl('entries')) return;

        $this->db_exp->set_table('entries');
        $this->db_exp->set_search_condition('form_type = "Local"');
        $this->db_exp->set_hidden(
            array(
                'form_type','age','sex','ID_type','transport_means','seat_no',
                'point_of_entry','visiting_purpose','other_visiting_purpose',
                'duration_stay','employment','address','hotel','region_id',
                'district_id','visit_area_ebola','taken_care_sick_person_ebola',
                'participated_burial_ebola','visit_area_corona',
                'taken_care_sick_person_corona','participated_burial_corona',
                'symptoms','other_symptoms','updated_at','updated_by','nationality',
                'street','mobile','email','location_origin'
            )
        );
        $this->db_exp->render('row_list');
        echo '<div class="dbx_wrapper" id="'.uniqid().'">'.$this->db_exp->output.'</div><script> make_table(); </script>';

    }

    public function users(){

        if($this->manage_tbl('modules')) return;

        $this->db_exp->set_table('users');
        $this->db_exp->set_arg_link("manage/act", '', 'Manage', $icon = 'icon-grid');
        $this->db_exp->render('row_list');
        echo '<div class="dbx_wrapper" id="'.uniqid().'">'.$this->db_exp->output.'</div><script> make_table(); </script>';

    }

    public function edit_modules(){
        $this->db_exp->set_table('modules');
        $this->db_exp->render('edit');
        echo '<div class="dbx_wrapper" id="'.uniqid().'">'.$this->db_exp->output.'</div><script> make_table(); </script>';
    }
    public function module_links(){
        
        $this->db_exp->set_table('module_links');
        $this->db_exp->set_hidden('module_id',$this->input->post('id'));
        $this->db_exp->render('row_list');
        echo '<div class="dbx_wrapper" id="'.uniqid().'">'.$this->db_exp->output.'</div><script> make_table(); </script>';

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