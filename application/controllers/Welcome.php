<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . '/third_party/faker/autoload.php';

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->view('welcome_message');
    }


    //get districts
    function get_districts($region_id)
    {
        log_message("DEBUG", "REACHES HERE");
        log_message("DEBUG", "region_id => " . $region_id);

        $districts = $this->district_model->get_many_by(['region_id' => $region_id]);

        if ($districts) {
            echo '<option value="">' . $this->lang->line('lbl_select') . '</option>';
            foreach ($districts as $value) {
                echo '<option value="' . $value->id . '" ' . set_value("district_id") . '>' . $value->name . '</option>';
            }
        } else {
            echo '<option value="">' . $this->lang->line('lbl_select') . '</option>';
        }
    }

    //get point of entries
    function get_poe($transport_means)
    {
        log_message("DEBUG", "REACHES HERE");
        log_message("DEBUG", "transport_means => " . $transport_means);

        $entries = $this->poe_model->get_many_by(['transport_means' => strtolower($transport_means)]);

        if ($entries) {
            echo '<option value="">' . $this->lang->line('lbl_select') . '</option>';
            foreach ($entries as $value) {
                echo '<option value="' . $value->id . '" ' . set_value("point_of_entry") . '>' . $value->name . '</option>';
            }
        } else {
            echo '<option value="">' . $this->lang->line('lbl_select') . '</option>';
        }
    }

    //dummy data
    function dummy($limit)
    {
        $faker = Faker\Factory::create();
        //$faker->seed(5);

        for ($i = 1; $i <= $limit; $i++) {
            $form_type = $this->_get_random_value_from_array(array('INTERNATIONAL', 'DOMESTIC'));

            if ($form_type == 'INTERNATIONAL')
                $location = $faker->numberBetween(1, 250);
            else
                $location = $faker->numberBetween(1, 32);


            $data = array(
                'form_type' => $form_type,
                'name' => $faker->name,
                'age' => $faker->numberBetween(1, 105),
                'sex' => $faker->randomElement(['Male', 'Female']),
                'nationality' => $faker->countryCode,
                'id_type' => $this->_get_random_value_from_array(['Passport No', 'National ID', 'Voters ID']),
                'ID_number' => $faker->ssn(),
                'transport_means' => $this->_get_random_value_from_array(['Flight', 'Vehicle', 'Vessel']),
                'transport_name' => 'AD' . $faker->numberBetween(5),
                'arrival_date' => date('Y-m-d'),
                'point_of_entry' => $faker->numberBetween(1, 5),
                'seat_no' => 'TZ' . $faker->numberBetween(),
                'visiting_purpose' => $this->_get_random_value_from_array(['Resident', 'Tourist', 'Transit', 'Business']),
                'other_visiting_purpose' => '',
                'duration_stay' => $faker->numberBetween(1, 100),
                'employment' => $this->_get_random_value_from_array(['Government', 'Non-Government', 'Non-Profit', 'Student', 'Business', 'Religious']),
                'address' => $faker->address,
                'hotel' => $this->_get_random_value_from_array(['Kilimanjaro', 'Holiday Inn']),
                'region_id' => $faker->numberBetween(1, 32),
                'district_id' => '',
                'street' => $faker->streetAddress,
                'mobile' => $faker->phoneNumber,
                'email' => $faker->email,
                'location_origin' => $location,
                'visit_area_ebola' => $this->_get_random_value_from_array(['Yes', 'No']),
                'taken_care_sick_person_ebola' => $this->_get_random_value_from_array(['Yes', 'No']),
                'participated_burial_ebola' => $this->_get_random_value_from_array(['Yes', 'No']),
                'visit_area_corona' => $this->_get_random_value_from_array(['Yes', 'No']),
                'taken_care_sick_person_corona' => $this->_get_random_value_from_array(['Yes', 'No']),
                'participated_burial_corona' => $this->_get_random_value_from_array(['Yes', 'No']),
                'symptoms' => join(',', $faker->randomElements([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14], 5)),
                'other_symptoms' => '',
                'temperature' => $faker->numberBetween(35, 40),
                'created_at' => date('Y-m-d H:i:s')
            );

            $score = $this->calculate_score($data);
            $data['score'] = $score;

            $this->entry_model->insert($data);
        }
    }

    //get rando from array
    function _get_random_value_from_array($array = array())
    {
        $rand_key = array_rand($array, 1);
        return $array[$rand_key];
    }

    /*===========================================
   Callback functions
   ===========================================*/
    function calculate_score($postVars)
    {
        $form_type = $postVars['form_type'];
        $location_id = $postVars['location_origin'];

        //location score
        $score = 1;
        if (strtoupper($form_type) == 'INTERNATIONAL') {
            $this->model->set_table('countries');
            $location = $this->model->get($location_id);

            if ($location)
                $score = $location->score;

        } else if (strtoupper($form_type) == 'DOMESTIC') {
            $location = $this->region_model->get($location_id);

            if ($location)
                $score = $location->score;
        }

        //symptoms score
        $symptoms = $postVars['symptoms'];
        $symptoms_score = $this->symptoms_score($symptoms);

        return $score + $symptoms_score;
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
