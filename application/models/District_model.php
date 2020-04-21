<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 06/06/2019
 * Time: 16:39
 */

class District_model extends CI_Model
{
    public $table = 'districts';
    public $primary_key = 'id';

    //get all
    function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    //find all
    function get_many_by($where)
    {
        return $this->db->get_where($this->table, $where)->result();
    }

    //get by
    function get_by($where)
    {
        return $this->db->get_where($this->table, $where)->row();
    }
}