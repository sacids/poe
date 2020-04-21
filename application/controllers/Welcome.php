<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
    function get_districts()
    {
        $region_id = $_POST['region_id'];
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
}
