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
                'form_type','age','sex','ID_type','seat_no',
                'point_of_entry','visiting_purpose','other_visiting_purpose',
                'duration_stay','employment','address','hotel','region_id',
                'district_id','visit_area_ebola','taken_care_sick_person_ebola',
                'participated_burial_ebola','visit_area_corona',
                'taken_care_sick_person_corona','participated_burial_corona',
                'symptoms','other_symptoms','updated_at','updated_by','nationality',
                'street','mobile','email','location_origin'
            )
        );

        //$this->db_exp->set_wrp_class('temperature','eip');

        $this->db_exp->set_select('action_taken',array('0' => 'Go soemewhere','1' => 'Nothing'));
        $this->db_exp->set_edit_in_place(array('temperature','action_taken'));
        $this->db_exp->set_wrp_class('score','score');
        $this->db_exp->show_insert_button = false;
        $this->db_exp->set_default_action('row_list');
        $this->db_exp->render();
        $output['output']   = $this->db_exp->output;
        $this->load->view('admin/db_exp/render',$output);

    }


    private function manage_entries($args){

        $this->model->set_table('entries');
        $row            = $this->model->as_array()->get($args['id']);
        $row['_title']  = 'Manage '.$row['name'];

        $tabs   = array();
        $tmp    = array(
            'label'     => 'Travellers Information',
            'method'    => 'screening/traveller_information/'.$row['id'],
            'render'    => 'edit',
            'args'      => 'id='.$row['id'],
        );
        array_push($tabs,$tmp);

        $tmp    = array(
            'label'     => 'Purpose',
            'method'    => 'screening/purpose/'.$row['id'],
            'render'    => 'list',
            'args'      => '',
        );
        array_push($tabs,$tmp);

        $tmp    = array(
            'label'     => 'Contacts in Tanzania',
            'method'    => 'screening/travellers_contacts/'.$row['id'],
            'render'    => 'list',
            'args'      => '',
        );
        array_push($tabs,$tmp);

        $tmp    = array(
            'label'     => 'Countries Visited',
            'method'    => 'screening/countries_visited/'.$row['id'],
            'render'    => 'list',
            'args'      => '',
        );
        array_push($tabs,$tmp);

        $tmp    = array(
            'label'     => 'Risk Activities',
            'method'    => 'screening/risk_activities/'.$row['id'],
            'render'    => 'list',
            'args'      => '',
        );
        array_push($tabs,$tmp);


        $tmp    = array(
            'label'     => 'Reported Symptoms',
            'method'    => 'screening/reported_symptoms/'.$row['id'],
            'render'    => 'list',
            'args'      => '',
        );
        array_push($tabs,$tmp);

        $this->make_tabs($tabs,$row);
    }

    public function reported_symptoms($id){

        $this->model->set_table('entries');
        $entry      = $this->model->get($id);
        $symptoms   = $entry->symptoms;

        $this->model->set_table('symptoms');
        $this->db->where("id in ($symptoms)");
        $results    = $this->model->get_all();

        $output['output']   = '';
        foreach($results as $result){
            $output['output'] .= '<h5>'.$result->name.'</h5>';
        }
        $this->load->view('admin/db_exp/render',$output);

    }

    public function risk_activities($id){

        $this->db_exp->set_table('entries');

        //$this->db_exp->set_search_condition('form_type = "'.$type.'"');
        $this->db_exp->set_hidden(
            array(
                'form_type','age','sex','ID_type','transport_means','seat_no',
                'point_of_entry','name','ID_number','vessel','transport_name','arrival_date',
                'duration_stay','visiting_purpose','temperature','action_taken',
                'district_id','region_id','mobile','email',
                'address','created_at',
                'hotel','location_origin',
                'symptoms','other_symptoms','updated_at','updated_by','nationality',
                'street','other_visiting_purpose','employment'
            )
        );
        $this->db_exp->set_html('<div class="col strong mb-2"><H4>COVID-19</H4></div>');
        $this->db_exp->set_view('visit_area_corona');
        $this->db_exp->set_view('taken_care_sick_person_corona');
        $this->db_exp->set_view('participated_burial_corona');

        $this->db_exp->set_html('<div class="col mb-2"><h4>EBOLA</h4></div>');
        $this->db_exp->set_view('visit_area_ebola');
        $this->db_exp->set_view('taken_care_sick_person_ebola');
        $this->db_exp->set_view('participated_burial_ebola');

        $this->db_exp->show_insert_button = false;
        $this->db_exp->render('edit');
        $output['output']   = $this->db_exp->output;
        $this->load->view('admin/db_exp/render',$output);

    }

    public function countries_visited($id){

        $this->db_exp->set_table('visited_areas');
        $this->db_exp->set_search_condition('entry_id = "'.$id.'"');
        $this->db_exp->set_hidden('entry_id');
        $this->db_exp->show_insert_button = false;
        $this->db_exp->render('row_list');
        $output['output']   = $this->db_exp->output;
        $this->load->view('admin/db_exp/render',$output);
    }

    public function travellers_contacts($id){

        $this->db_exp->set_table('entries');

        //$this->db_exp->set_search_condition('form_type = "'.$type.'"');
        $this->db_exp->set_hidden(
            array(
                'form_type','age','sex','ID_type','transport_means','seat_no',
                'point_of_entry','name','ID_number','vessel','transport_name','arrival_date',
                'duration_stay','visiting_purpose','temperature','action_taken',
                'visit_area_ebola','taken_care_sick_person_ebola',
                'participated_burial_ebola','visit_area_corona','created_at',
                'taken_care_sick_person_corona','participated_burial_corona',
                'symptoms','other_symptoms','updated_at','updated_by','nationality',
                'street','other_visiting_purpose','employment'
            )
        );


        $this->db_exp->set_view('address');
        $this->db_exp->set_view('hotel');

        $this->db_exp->set_html('<div class="row mx-1">');
        $this->db_exp->set_view('location_origin');
        $this->db_exp->set_view('region_id');
        $this->db_exp->set_view('district_id');
        $this->db_exp->set_html('</div>');

        $this->db_exp->set_view('mobile');
        $this->db_exp->set_view('email');

        $this->db_exp->render('edit');
        $output['output']   = $this->db_exp->output;
        $this->load->view('admin/db_exp/render',$output);

    }
    public function purpose($id){

        $this->db_exp->set_table('entries');

        //$this->db_exp->set_search_condition('form_type = "'.$type.'"');
        $this->db_exp->set_hidden(
            array(
                'form_type','age','sex','ID_type','transport_means','seat_no',
                'point_of_entry','name','ID_number','vessel','transport_name','arrival_date',
                'duration_stay','address','hotel','region_id','temperature','action_taken',
                'district_id','visit_area_ebola','taken_care_sick_person_ebola',
                'participated_burial_ebola','visit_area_corona','created_at',
                'taken_care_sick_person_corona','participated_burial_corona',
                'symptoms','other_symptoms','updated_at','updated_by','nationality',
                'street','mobile','email','location_origin'
            )
        );


        $this->db_exp->set_view('visiting_purpose');
        $this->db_exp->set_view('other_visiting_purpose');
        $this->db_exp->set_view('duration_stay');
        $this->db_exp->set_view('employment');

        $this->db_exp->render('edit');
        $output['output']   = $this->db_exp->output;
        $this->load->view('admin/db_exp/render',$output);
    }

    public function traveller_information($id){

        $this->db_exp->set_table('entries');

        //$this->db_exp->set_search_condition('form_type = "'.$type.'"');
        $this->db_exp->set_hidden(
            array(
                'form_type','created_at',
                'visiting_purpose','other_visiting_purpose',
                'duration_stay','employment','address','hotel','region_id',
                'district_id','visit_area_ebola','taken_care_sick_person_ebola',
                'participated_burial_ebola','visit_area_corona',
                'taken_care_sick_person_corona','participated_burial_corona',
                'symptoms','other_symptoms','updated_at','updated_by',
                'street','mobile','email','location_origin','mobile','email'
            )
        );

        $this->db_exp->set_view('name');

        $this->db_exp->set_html('<div class="row mx-1">');
        $this->db_exp->set_view('age');
        $this->db_exp->set_view('sex');
        $this->db_exp->set_view('nationality');
        $this->db_exp->set_html('</div>');


        $this->db_exp->set_html('<div class="row mx-1">');
        $this->db_exp->set_view('ID_number');
        $this->db_exp->set_view('ID_type');
        $this->db_exp->set_html('</div>');

        $this->db_exp->set_html('<div class="row mx-1">');
        $this->db_exp->set_view('transport_means');
        $this->db_exp->set_view('transport_name');
        $this->db_exp->set_view('seat_no');
        $this->db_exp->set_html('</div>');

        $this->db_exp->set_view('arrival_date');
        $this->db_exp->set_view('point_of_entry');

        $this->db_exp->set_pri_id($id);
        $this->db_exp->render('edit');
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