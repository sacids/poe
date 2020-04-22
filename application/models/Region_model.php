<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 06/06/2019
 * Time: 16:39
 */

class Region_model extends CI_Model
{
    public $table = 'regions';
    public $primary_key = 'id';


    //get all regions
    function get_all()
    {
        return $this->db->order_by('name', 'ASC')->get($this->table)->result();
    }

    //find all
    function get_many_by($where)
    {
        return $this->db->get_where($this->table, $where)->result();
    }

    //get
    function get($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    //get by
    function get_by($where)
    {
        return $this->db->get_where($this->table, $where)->row();
    }
}