<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Member_model;

//加入跨域設定
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}

class Member extends Controller
{
    public function index()
    {
        helper(['form', 'url']);
        $this->Member_model = new Member_model();
        $data['member'] = $this->Member_model->get_all_member();
        return view('member_view', $data);
    }

    public function member_add()
    {

        helper(['form', 'url']);
        $this->Member_model = new Member_model();

        $data = array(
            'name' => $this->request->getPost('name'),
            'ename' => $this->request->getPost('ename'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'sex' => $this->request->getPost('sex'),
            'city' => $this->request->getPost('city'),
            'township' => $this->request->getPost('township'),
            'postcode' => $this->request->getPost('postcode'),
            'address' => $this->request->getPost('address'),
            'notes' => $this->request->getPost('notes'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->Member_model->member_add($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id)
    {

        $this->Member_model = new Member_model();

        $data = $this->Member_model->get_by_id($id);

        echo json_encode($data);
    }

    public function member_update()
    {

        helper(['form', 'url']);
        $this->Member_model = new Member_model();

        $data = array(
            'name' => $this->request->getPost('name'),
            'ename' => $this->request->getPost('ename'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'sex' => $this->request->getPost('sex'),
            'city' => $this->request->getPost('city'),
            'township' => $this->request->getPost('township'),
            'postcode' => $this->request->getPost('postcode'),
            'address' => $this->request->getPost('address'),
            'notes' => $this->request->getPost('notes'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->Member_model->member_update(array('id' => $this->request->getPost('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function member_delete($id)
    {

        helper(['form', 'url']);
        $this->Member_model = new Member_model();
        $this->Member_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
}
