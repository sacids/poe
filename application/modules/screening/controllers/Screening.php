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

    public function international(){
        $this->domestic('international');
    }

    public function domestic($type = 'Local'){

        if($this->manage_tbl('entries')) return;
        $this->db_exp->set_table('entries');

        if(! (array_key_exists('action',$_GET) && $this->input->get('action') == 'edit')){
            $data['title']      = ucfirst(strtolower($type)).' Entries Management';
            $data['description']    = 'Review and update information pertaining to '.ucfirst(strtolower($type)).' travellers';
            $this->load->view('admin/common/title',$data);
        }

        //$this->db_exp->set_search_condition('form_type = "'.$type.'"');
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

        $this->db_exp->show_insert_button = false;
        $this->db_exp->render('row_list');
        $output['output']   = $this->db_exp->output;
        $this->load->view('admin/db_exp/render',$output);

    }




    public function community(){
        echo 'community';
    }

    public function self(){
        echo 'self';
    }
}