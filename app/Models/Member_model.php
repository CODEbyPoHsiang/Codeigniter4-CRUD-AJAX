<?php

namespace App\Models;

use CodeIgniter\Model;

class Member_model extends Model
{
    protected $table = 'member';

    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
        $db = \Config\Database::connect();
        $db->table('member');
    }

    public function get_all_member()
    {
        return $this->db->query("SELECT * FROM member;")->getResult();
        // return $this->db->table('member')->get()->getResultArray();
        //      print_r($query->getResult());
        // $query = $this->db->get();
    }

    public function get_by_id ($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id])->getRowArray();
        }
    }

    // public function get_by_id($id)
    // {
    //     $sql = "SELECT * FROM member WHERE id =" . $id;
    //     $query =  $this->db->query($sql);

    //     return $query->getRow();
    // }

    public function member_add($data)
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function member_update($data,$id)
    {
       return  $this->db->table($this->table)->update($data, array('id' => $id));
    //    return  $this->db->table($this->table)->update( ['id' => $id]); 
        //        print_r($this->db->getLastQuery());
        
    }
    
    // public function updateCategory($data, $id)
    // {
    //     return $this->db->table($this->table)->update($data, ['category_id' => $id]);
    // }

    public function delete_by_id($id)
    {
        return $this->db->table($this->table)->delete(array('id' => $id));
    }
}
