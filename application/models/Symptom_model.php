<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 02/04/2020
 * Time: 15:45
 */

class Symptom_model extends CI_Model
{
    public $table = "symptoms";
    public $primary_key = 'id';

    //insert
    function insert($data)
    {
        $result = $this->db->insert($this->table, $data);

        if ($result)
            return $this->db->insert_id();
        else
            return null;
    }

    //update
    function update($id, $data)
    {
        return $this->db->update($this->table, $data, ['id' => $id]);
    }

    //update by
    function update_by($where, $data)
    {
        return $this->db->update($this->table, $data, $where);
    }

    //update
    function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    //update
    function delete_by($where)
    {
        return $this->db->delete($this->table, $where);
    }

    //count all
    function count_all()
    {
        return $this->db->get($this->table)->num_rows();
    }

    //count many
    function count_many_by($where)
    {
        return $this->db->get_where($this->table, $where)->num_rows();
    }

    //order by
    function order_by($field, $condition)
    {
        $this->db->order_by($field, $condition);
    }

    //order by
    function limit($num, $start)
    {
        $this->db->limit($num, $start);
    }

    //get all
    function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    //get all
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

    //find table columns
    public function find_table_columns($table_name)
    {
        return $this->db->list_fields($table_name);
    }

    //find table data
    public function find_table_columns_data($table_name)
    {
        return $this->db->field_data($table_name);
    }
}