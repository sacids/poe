<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 01/04/2020
 * Time: 11:43
 */

class Entries extends MX_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    //default page
    function index()
    {
        $this->data['title'] = 'Point of Entry International';

        //render view
        $this->load->view('header', $this->data);
        $this->load->view('index');
        $this->load->view('footer');
    }

    //international transport
    function international()
    {
        $this->data['title'] = 'Point of Entry International';

        //success form validation
        if (isset($_POST) && $_POST) {
            //symptoms
            $symptoms = [];
            if ($_POST['symptoms']) {
                foreach ($_POST['symptoms'] as $symptom) {
                    array_push($symptoms, $symptom);
                }
            }

            //data
            $data = array(
                'form_type' => $this->input->post('form_type'),
                'name' => $this->input->post('name'),
                'age' => $this->input->post('age'),
                'sex' => $this->input->post('sex'),
                'nationality' => $this->input->post('nationality'),
                'id_type' => $this->input->post('id_type'),
                'ID_number' => $this->input->post('passport_number'),
                'transport_means' => $this->input->post('transport_means'),
                'transport_name' => $this->input->post('transport_name'),
                'arrival_date' => $this->input->post('arrival_date'),
                'point_of_entry' => $this->input->post('point_of_entry'),
                'seat_no' => $this->input->post('seat_no'),
                'visiting_purpose' => $this->input->post('visiting_purpose'),
                'other_visiting_purpose' => $this->input->post('other_visiting_purpose'),
                'duration_stay' => $this->input->post('duration_stay'),
                'employment' => $this->input->post('employment'),
                'address' => $this->input->post('address'),
                'hotel' => $this->input->post('hotel'),
                'region_id' => $this->input->post('region_id'),
                'district_id' => $this->input->post('district_id'),
                'street' => $this->input->post('street'),
                'mobile' => $this->input->post('mobile'),
                'email' => $this->input->post('email'),
                'location_origin' => $this->input->post('location_origin'),
                'visit_area_ebola' => $this->input->post('visit_area_ebola'),
                'taken_care_sick_person_ebola' => $this->input->post('taken_care_sick_person_ebola'),
                'participated_burial_ebola' => $this->input->post('participated_burial_ebola'),
                'visit_area_corona' => $this->input->post('visit_area_corona'),
                'taken_care_sick_person_corona' => $this->input->post('taken_care_sick_person_corona'),
                'participated_burial_corona' => $this->input->post('participated_burial_corona'),
                'symptoms' => join(',', $symptoms),
                'other_symptoms' => $this->input->post('other_symptoms'),
                'created_at' => date('Y-m-d H:i:s')
            );

            $score = $this->calculate_score($data);
            $data['score'] = $score;

            //insert data
            if ($id = $this->entry_model->insert($data)) {
                //todo: countries visited within 24 hours
                if ($_POST['country']) {
                    for ($i = 0; $i < sizeof($_POST['country']); $i++) {
                        $this->visited_area_model->insert(
                            [
                                'entry_id' => $id,
                                'area' => $_POST['country'][$i],
                                'location' => $_POST['location'][$i],
                                'visit_date' => $_POST['date'][$i],
                                'no_of_days' => $_POST['days'][$i],
                            ]
                        );
                    }
                }

                $this->session->set_flashdata('message', display_message($this->lang->line('lbl_successful_msg')));
            } else {
                $this->session->set_flashdata('message', display_message($this->lang->line('lbl_failed_msg'), 'danger'));
            }
            redirect('entries/international', 'refresh');
        }

        //populate data
        $this->data['symptoms'] = $this->symptom_model->get_all();
        $this->data['entries'] = $this->poe_model->get_all();

        //countries
        $this->model->set_table('countries');
        $this->data['countries'] = $this->model->order_by('name', 'ASC')->get_all();

        //regions
        $this->data['regions'] = $this->region_model->get_all();

        //districts
        $this->data['districts'] = $this->district_model->get_all();

        //render view
        $this->load->view('header', $this->data);
        $this->load->view('international');
        $this->load->view('footer');
    }

    //local transport
    function local()
    {
        $this->data['title'] = 'Point of Entry Local';

        //success form validation
        if (isset($_POST) && $_POST) {
            //symptoms
            $symptoms = [];
            if ($_POST['symptoms']) {
                foreach ($_POST['symptoms'] as $symptom) {
                    array_push($symptoms, $symptom);
                }
            }

            //data
            $data = array(
                'form_type' => $this->input->post('form_type'),
                'name' => $this->input->post('name'),
                'age' => $this->input->post('age'),
                'sex' => $this->input->post('sex'),
                'nationality' => $this->input->post('nationality'),
                'id_type' => $this->input->post('id_type'),
                'ID_number' => $this->input->post('identification_number'),
                'transport_means' => $this->input->post('transport_means'),
                'transport_name' => $this->input->post('transport_name'),
                'arrival_date' => $this->input->post('arrival_date'),
                'point_of_entry' => $this->input->post('point_of_entry'),
                'seat_no' => $this->input->post('seat_no'),
                'visiting_purpose' => $this->input->post('visiting_purpose'),
                'other_visiting_purpose' => $this->input->post('other_visiting_purpose'),
                'duration_stay' => $this->input->post('duration_stay'),
                'employment' => $this->input->post('employment'),
                'address' => $this->input->post('address'),
                'hotel' => $this->input->post('hotel'),
                'region_id' => $this->input->post('region_id'),
                'district_id' => $this->input->post('district_id'),
                'street' => $this->input->post('street'),
                'mobile' => $this->input->post('mobile'),
                'email' => $this->input->post('email'),
                'location_origin' => $this->input->post('region_origin'),
                'visit_area_ebola' => $this->input->post('visit_area_ebola'),
                'taken_care_sick_person_ebola' => $this->input->post('taken_care_sick_person_ebola'),
                'participated_burial_ebola' => $this->input->post('participated_burial_ebola'),
                'visit_area_corona' => $this->input->post('visit_area_corona'),
                'taken_care_sick_person_corona' => $this->input->post('taken_care_sick_person_corona'),
                'participated_burial_corona' => $this->input->post('participated_burial_corona'),
                'symptoms' => join(',', $symptoms),
                'other_symptoms' => $this->input->post('other_symptoms'),
                'created_at' => date('Y-m-d H:i:s')
            );

            $score = $this->calculate_score($data);
            $data['score'] = $score;

            if ($id = $this->entry_model->insert($data)) {
                //todo: countries visited within 24 hours
                if ($_POST['region']) {
                    for ($i = 0; $i < sizeof($_POST['region']); $i++) {
                        $this->visited_area_model->insert(
                            [
                                'entry_id' => $id,
                                'area' => $_POST['region'][$i],
                                'location' => $_POST['location'][$i],
                                'visit_date' => $_POST['date'][$i],
                                'no_of_days' => $_POST['days'][$i],
                            ]
                        );
                    }
                }

                $this->session->set_flashdata('message', display_message($this->lang->line('lbl_successful_msg')));
            } else {
                $this->session->set_flashdata('message', display_message($this->lang->line('lbl_failed_msg'), 'danger'));
            }
            redirect('entries/local', 'refresh');
        }

        //populate data
        $this->data['symptoms'] = $this->symptom_model->get_all();
        $this->data['entries'] = $this->poe_model->get_all();

        //countries
        $this->model->set_table('countries');
        $this->data['countries'] = $this->model->order_by('name', 'ASC')->get_all();

        //regions
        $this->data['regions'] = $this->region_model->get_all();

        //districts
        $this->data['districts'] = $this->district_model->get_all();

        //render view
        $this->load->view('header', $this->data);
        $this->load->view('local');
        $this->load->view('footer');
    }

    //lists
    function lists()
    {
        //title
        $this->data['title'] = 'PoE Surveillance';

        //check login
        if (!$this->ion_auth->logged_in())
            redirect('auth/login', 'refresh');

        //check for search
        if (isset($_POST['search'])) {
            //post data
            $name = $this->input->post('name');
            $ID_No = $this->input->post('ID_number');
            $vessel = $this->input->post('vessel');
            $arrival_date = $this->input->post('arrival_date');

            //search
            $entries = $this->entry_model->search_all($name, $ID_No, $vessel, $arrival_date);

            if ($entries) {
                $this->data['entries'] = $entries;

                foreach ($this->data['entries'] as $k => $v) {
                    $this->model->set_table('countries');
                    $this->data['entries'][$k]->country = $this->model->get_by('code', $v->nationality);
                }
            } else {
                $this->data['entries'] = [];
            }
        } else {
            //table data
            $entries = $this->entry_model->get_all();
            $this->data['entries'] = $entries;

            foreach ($this->data['entries'] as $k => $v) {
                $this->model->set_table('countries');
                $this->data['entries'][$k]->country = $this->model->get_by('code', $v->nationality);
            }
        }

        //render view
        $this->load->view('admin/header', $this->data);
        $this->load->view('entries/lists');
        $this->load->view('admin/footer');
    }

    //details
    function details($id)
    {
        //title
        $this->data['title'] = 'Information';

        $this->model->set_table('poe_entries');
        $entry = $this->model->get($id);

        if (!$entry)
            show_error('Entry not found');

        $this->data['entry'] = $entry;

        if ($entry->symptoms) {
            $symptoms = [];
            $arr = explode(',', $entry->symptoms);
            foreach ($arr as $symptom) {
                $val = $this->symptom_model->get($symptom);
                array_push($symptoms, $val->name);
            }
            $this->data['symptoms'] = join(', ', $symptoms);
        } else {
            $this->data['symptoms'] = '';
        }

        //form validation
        //$this->form_validation->set_rules('temperature', 'Temperature', 'required');

        if ($this->form_validation->run() === TRUE) {
            $data = ['temperature' => $this->input->post('temperature')];

            $this->model->set_table('poe_entries');
            if ($this->model->update($id, $data)) {
                $this->session->set_flashdata('message', display_message('Temperature recorded'));
            } else {
                $this->session->set_flashdata('message', display_message('Failed to record temperature', 'danger'));
            }
            redirect(uri_string(), 'refresh');
        }

        //populate data
        $this->data['temperature'] = array(
            'name' => 'temperature',
            'id' => 'temperature',
            'type' => 'hidden',
            'value' => $this->form_validation->set_value('temperature'),
            'class' => 'form-control',
            'placeholder' => 'Record temperature...'
        );

        //render view
        $this->load->view('admin/header', $this->data);
        $this->load->view('entries/edit_temp');
        $this->load->view('admin/footer');
    }

    //record temp
    function record_temp()
    {
        $id = $_POST['entry_id'];
        $temp = $_POST['temp'];

        if (!empty($temp)) {
            $data = ['temperature' => $temp];

            //update temp
            if ($this->entry_model->update($id, $data)) {
                log_message("DEBUG", "data updated");
            } else {
                log_message("DEBUG", "failed to update updated");
            }

            $array = ['status' => 'success', 'message' => 'Temperature recorded'];
        } else {
            $array = ['status' => 'failed', 'message' => 'Failed to record temperature'];
        }
        echo json_encode($array);
    }


    /*===========================================
    Callback functions
    ===========================================*/
    function calculate_score($postVars)
    {
        $form_type = $postVars['form_type'];
        $location_id = $postVars['location_origin'];

        //location score
        $location = [];
        if (strtoupper($form_type) == 'INTERNATIONAL') {
            $this->model->set_table('countries');
            $location = $this->model->get($location_id);
        } else if (strtoupper($form_type) == 'DOMESTIC') {
            $location = $this->region_model->get($location_id);
        }

        //symptoms score
        $symptoms = $_POST['symptoms'];
        $symptoms_score = $this->symptoms_score($symptoms);

        return $location->score + $symptoms_score;
    }

    //calculate sum score of threshold
    function symptoms_score($symptoms)
    {
        $sum = 0;
        $query = $this->db->select('SUM(score) as score')->where_in('id', $symptoms)->get('symptoms')->result();
        log_message("DEBUG", "query => " . $this->db->last_query());

        foreach ($query as $value) {
            if ($value->score != null)
                $sum = $value->score;
        }
        log_message("DEBUG", "score => " . $sum);
        return $sum;
    }
}