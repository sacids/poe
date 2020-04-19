<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 01/04/2020
 * Time: 11:20
 */

class Dashboard extends CI_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }


    function index()
    {
        $this->data['title'] = 'System Overview';


        //render view
        $this->load->view('admin/header', $this->data);
        $this->load->view('admin/index');
        $this->load->view('admin/footer');
    }
}