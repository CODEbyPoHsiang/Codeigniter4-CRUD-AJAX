<?php

namespace App\Models;

use CodeIgniter\Model;

class Member_model extends Model
{

    var $table = 'member';

    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
        $db = \Config\Database::connect();
        $db->table('member');
    }

    public function get_all_member()
    {
        $query = $this->db->query('select * from member');
        //      print_r($query->getResult());
        // $query = $this->db->get();
        return $query->getResult();
    }

    public function get_by_id($id)
    {
        $sql = 'select * from member where id =' . $id;
        $query =  $this->db->query($sql);

        return $query->getRow();
    }

    public function member_add($data)
    {

        $add_query = $this->db->table($this->table)->insert($data);

        return $add_query;
    }

    public function member_update($where, $data)
    {
        $update_query = $this->db->table($this->table)->update($data, $where);
        //        print_r($this->db->getLastQuery());
        return $update_query;
    }

    public function delete_by_id($id)
    {
        $this->db->table($this->table)->delete(array('id' => $id));
    }
}
