<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 01/04/2020
 * Time: 11:43
 */

class Admin extends MX_Controller
{

    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model');
        $this->load->library('db_exp');

    }

    //dashboard
    public function dashboard()
    {
        //array lists
        $poe_array = [];
        $passengers_array = [];
        $symptoms_array = [];
        $symptom_occurrences_array = [];

        //if post filter
        if (isset($_POST['filter'])) {
            $day = $this->input->post('day');

            $where = [];
            if ($day == 'today')
                $where = ['DATE(arrival_date)' => date('Y-m-d')];
            else if ($day == 'yesterday')
                $where = ['DATE(arrival_date)' => date('Y-m-d', strtotime('-1 day'))];
            else if ($day == 'last_week')
                $where = []; //todo
            else if ($day == 'last_month')
                $where = ['MONTH(arrival_date)' => date('m', strtotime('-1 month')), 'YEAR(arrival_date)' => date('Y')];
            else if ($day == 'overall')
                $where = [];

            //total no of passenger
            $this->data['total_passengers'] = $this->entry_model->count_many_by($where);

            //male and female
            $male = 0;
            $female = 0;
            $all_passengers = $this->entry_model->get_total_by_gender($where);
            if ($all_passengers) {
                if (isset($all_passengers[0]))
                    $male = $all_passengers[0]->passengers;

                if (isset($all_passengers[1]))
                    $female = $all_passengers[1]->passengers;
            }

            $this->data['male'] = $male;
            $this->data['female'] = $female;

            //total_male_female
            $this->data['total_male_female'] = $male + $female;

            //above temperature
            $ab_where = ['temperature >=' => 38] + $where;
            $this->data['total_above_temp'] = $this->entry_model->get_many_by($ab_where);

            //below temperature
            $bl_where = ['temperature <' => 35] + $where;
            $this->data['total_below_temp'] = $this->entry_model->get_many_by($bl_where);

            //normal temperature
            $nm_where = ['temperature >=' => 35, 'temperature < ' => 38] + $where;
            $this->data['total_normal_temp'] = $this->entry_model->get_many_by($nm_where);

            //point of entries
            $poe = $this->poe_model->get_all();
            foreach ($poe as $value) {
                //json data creation
                $poe_array[] = $value->name;

                //passenger per poe
                $s_where = ['point_of_entry' => $value->id] + $where;
                $passengers = $this->entry_model->count_many_by($s_where);
                $passengers_array[] = (int)$passengers;
            }

            //reported symptoms
            $symptoms = $this->symptom_model->get_many_by(['id !=' => 1000]);

            //entries
            $entries = $this->entry_model->get_many_by($where);

            foreach ($symptoms as $value) {
                $symptoms_array[] = $value->name;

                //select from poe
                $i = 0;
                foreach ($entries as $entry) {
                    $st = explode(',', $entry->symptoms);

                    if (in_array($value->id, $st))
                        $i++;
                }

                //number of symptoms
                $symptom_occurrences_array[] = (int)$i;
            }

            //form type
            $international = $this->entry_model->count_many_by_type('International', $where);
            $domestic = $this->entry_model->count_many_by_type('Domestic', $where);

            //action taken
            $secondary_screening = $this->entry_model->count_many_by_action_taken(1, $where);
            $allowed_proceed = $this->entry_model->count_many_by_action_taken(0, $where);
        } else {
            //total no of passenger
            $this->data['total_passengers'] = $this->entry_model->count_all();

            //male and female
            $male = 0;
            $female = 0;
            $all_passengers = $this->entry_model->get_total_by_gender();
            if ($all_passengers) {
                if (isset($all_passengers[0]))
                    $male = $all_passengers[0]->passengers;

                if (isset($all_passengers[1]))
                    $female = $all_passengers[1]->passengers;
            }

            $this->data['male'] = $male;
            $this->data['female'] = $female;

            //total_male_female
            $this->data['total_male_female'] = $male + $female;

            //above temperature
            $this->data['total_above_temp'] = $this->entry_model->get_many_by(['temperature >=' => 38]);

            //below temperature
            $this->data['total_below_temp'] = $this->entry_model->get_many_by(['temperature <' => 35]);

            //normal temperature
            $this->data['total_normal_temp'] = $this->entry_model->get_many_by(['temperature >=' => 35, 'temperature < ' => 38]);

            //point of entries
            $poe = $this->poe_model->get_all();
            foreach ($poe as $value) {
                //json data creation
                $poe_array[] = $value->name;

                //passenger per poe
                $passengers = $this->entry_model->count_many_by(['point_of_entry' => $value->id]);
                $passengers_array[] = (int)$passengers;
            }

            //reported symptoms
            $symptoms = $this->symptom_model->get_many_by(['id !=' => 1000]);

            //entries
            $entries = $this->entry_model->get_all();

            foreach ($symptoms as $value) {
                $symptoms_array[] = $value->name;

                //select from poe
                $i = 0;
                foreach ($entries as $entry) {
                    $st = explode(',', $entry->symptoms);

                    if (in_array($value->id, $st))
                        $i++;
                }

                //number of symptoms
                $symptom_occurrences_array[] = (int)$i;
            }

            //form type
            $international = $this->entry_model->count_many_by(['form_type' => 'International']);
            $domestic = $this->entry_model->count_many_by(['form_type' => 'Domestic']);

            //action taken
            $secondary_screening = $this->entry_model->count_many_by(['action_taken' => 1]);
            $allowed_proceed = $this->entry_model->count_many_by(['action_taken' => 0]);
        }

        //passengers
        $this->data['international'] = $international;
        $this->data['domestic'] = $domestic;

        //action taken
        $this->data['secondary_screening'] = $secondary_screening;
        $this->data['allowed_proceed'] = $allowed_proceed;

        //json data
        $this->data['poe_array'] = json_encode($poe_array);
        $this->data['passengers_array'] = json_encode($passengers_array);
        $this->data['symptoms_array'] = json_encode($symptoms_array);
        $this->data['symptom_occurrences_array'] = json_encode($symptom_occurrences_array);

        $data['title'] = 'Dashboard';
        $data['description'] = 'System stats';

        //render view
        $this->load->view('main', $this->data);
    }

    //dashboard
    public function index()
    {
        $this->data['title'] = 'System Overview';

        $this->model->set_table('modules');
        $results = $this->model->get_all();
        $this->model->set_table('module_links');
        $holder = array();
        foreach ($results as $result) {
            $holder[$result->id]['props'] = $result;
            $holder[$result->id]['link'] = $result->link;
            if (!$result->link) {
                $links = $this->model->get_many_by('module_id', $result->id);
                $holder[$result->id]['link'] = $links;
            }
        }

        $data['modules'] = $holder;

        //array lists
        $poe_array = [];
        $passengers_array = [];
        $symptoms_array = [];
        $symptom_occurrences_array = [];

        //if post filter
        if (isset($_POST['filter'])) {
            $day = $this->input->post('day');

            $where = [];
            if ($day == 'today')
                $where = ['DATE(arrival_date)' => date('Y-m-d')];
            else if ($day == 'yesterday')
                $where = ['DATE(arrival_date)' => date('Y-m-d', strtotime('-1 day'))];
            else if ($day == 'last_week')
                $where = []; //todo
            else if ($day == 'last_month')
                $where = ['MONTH(arrival_date)' => date('m', strtotime('-1 month')), 'YEAR(arrival_date)' => date('Y')];
            else if ($day == 'overall')
                $where = [];

            //total no of passenger
            $this->data['total_passengers'] = $this->entry_model->count_many_by($where);

            //male and female
            $male = 0;
            $female = 0;
            $all_passengers = $this->entry_model->get_total_by_gender($where);
            if ($all_passengers) {
                if (isset($all_passengers[0]))
                    $male = $all_passengers[0]->passengers;

                if (isset($all_passengers[1]))
                    $female = $all_passengers[1]->passengers;
            }

            $this->data['male'] = $male;
            $this->data['female'] = $female;

            //total_male_female
            $this->data['total_male_female'] = $male + $female;

            //above temperature
            $ab_where = ['temperature >=' => 38] + $where;
            $this->data['total_above_temp'] = $this->entry_model->get_many_by($ab_where);

            //below temperature
            $bl_where = ['temperature <' => 35] + $where;
            $this->data['total_below_temp'] = $this->entry_model->get_many_by($bl_where);

            //normal temperature
            $nm_where = ['temperature >=' => 35, 'temperature < ' => 38] + $where;
            $this->data['total_normal_temp'] = $this->entry_model->get_many_by($nm_where);

            //point of entries
            $poe = $this->poe_model->get_all();
            foreach ($poe as $value) {
                //json data creation
                $poe_array[] = $value->name;

                //passenger per poe
                $s_where = ['point_of_entry' => $value->id] + $where;
                $passengers = $this->entry_model->count_many_by($s_where);
                $passengers_array[] = (int)$passengers;
            }

            //reported symptoms
            $symptoms = $this->symptom_model->get_many_by(['id !=' => 1000]);

            //entries
            $entries = $this->entry_model->get_many_by($where);

            foreach ($symptoms as $value) {
                $symptoms_array[] = $value->name;

                //select from poe
                $i = 0;
                foreach ($entries as $entry) {
                    $st = explode(',', $entry->symptoms);

                    if (in_array($value->id, $st))
                        $i++;
                }

                //number of symptoms
                $symptom_occurrences_array[] = (int)$i;
            }

            //form type
            $international = $this->entry_model->count_many_by_type('International', $where);
            $domestic = $this->entry_model->count_many_by_type('Domestic', $where);

            //action taken
            $secondary_screening = $this->entry_model->count_many_by_action_taken(1, $where);
            $allowed_proceed = $this->entry_model->count_many_by_action_taken(0, $where);
        } else {
            //total no of passenger
            $this->data['total_passengers'] = $this->entry_model->count_all();

            //male and female
            $male = 0;
            $female = 0;
            $all_passengers = $this->entry_model->get_total_by_gender();
            if ($all_passengers) {
                if (isset($all_passengers[0]))
                    $male = $all_passengers[0]->passengers;

                if (isset($all_passengers[1]))
                    $female = $all_passengers[1]->passengers;
            }

            $this->data['male'] = $male;
            $this->data['female'] = $female;

            //total_male_female
            $this->data['total_male_female'] = $male + $female;

            //above temperature
            $this->data['total_above_temp'] = $this->entry_model->get_many_by(['temperature >=' => 38]);

            //below temperature
            $this->data['total_below_temp'] = $this->entry_model->get_many_by(['temperature <' => 35]);

            //normal temperature
            $this->data['total_normal_temp'] = $this->entry_model->get_many_by(['temperature >=' => 35, 'temperature < ' => 38]);

            //point of entries
            $poe = $this->poe_model->get_all();
            foreach ($poe as $value) {
                //json data creation
                $poe_array[] = $value->name;

                //passenger per poe
                $passengers = $this->entry_model->count_many_by(['point_of_entry' => $value->id]);
                $passengers_array[] = (int)$passengers;
            }

            //reported symptoms
            $symptoms = $this->symptom_model->get_many_by(['id !=' => 1000]);

            //entries
            $entries = $this->entry_model->get_all();

            foreach ($symptoms as $value) {
                $symptoms_array[] = $value->name;

                //select from poe
                $i = 0;
                foreach ($entries as $entry) {
                    $st = explode(',', $entry->symptoms);

                    if (in_array($value->id, $st))
                        $i++;
                }

                //number of symptoms
                $symptom_occurrences_array[] = (int)$i;
            }

            //form type
            $international = $this->entry_model->count_many_by(['form_type' => 'International']);
            $domestic = $this->entry_model->count_many_by(['form_type' => 'Domestic']);

            //action taken
            $secondary_screening = $this->entry_model->count_many_by(['action_taken' => 1]);
            $allowed_proceed = $this->entry_model->count_many_by(['action_taken' => 0]);
        }

        //passengers
        $this->data['international'] = $international;
        $this->data['domestic'] = $domestic;

        //action taken
        $this->data['secondary_screening'] = $secondary_screening;
        $this->data['allowed_proceed'] = $allowed_proceed;

        //json data
        $this->data['poe_array'] = json_encode($poe_array);
        $this->data['passengers_array'] = json_encode($passengers_array);
        $this->data['symptoms_array'] = json_encode($symptoms_array);
        $this->data['symptom_occurrences_array'] = json_encode($symptom_occurrences_array);

        $data['title'] = 'Dashboard';
        $data['description'] = 'System stats';

        //render view
        $this->load->view('common/head', $this->data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('common/header');
        $this->load->view('main');
        $this->load->view('common/footer');
        $this->load->view('common/foot');
    }

    public function edit_field()
    {

        $get = $this->input->get();
        $table = base64_decode($get['t']);
        $id = $get['i'];
        $val = $get['v'];
        $fld = $get['f'];

        $this->model->set_table($table);
        if ($this->model->update($id, array($fld => $val))) {
            log_message('DEBUG', 'ADMIN : edit_field : success : ' . json_encode($get));
            echo 1;
        } else {
            log_message('DEBUG', 'ADMIN : edit_field : failed : ' . json_encode($get));
            echo 0;
        }
    }

    public function modules()
    {

        $this->db_exp->set_table('modules');
        $this->db_exp->render('row_list');
        echo '<div class="dbx_wrapper" id="' . uniqid() . '">' . $this->db_exp->output . '</div>';

    }


    public function dashboard1()
    {

        $this->module->set_table('entries');
        //$where  = 

    }
}