<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 19/04/2020
 * Time: 13:04
 */

class Quarantines extends MX_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    //lists
    function lists()
    {
        //title
        $this->data['title'] = 'PoE Surveillance';

        //check login
        if (!$this->ion_auth->logged_in())
            redirect('auth/login', 'refresh');

        //table data
        $entries = $this->entry_model->get_all();
        $this->data['entries'] = $entries;


        //render view
        $this->load->view('admin/header', $this->data);
        $this->load->view('quarantines/lists');
        $this->load->view('admin/footer');
    }
}