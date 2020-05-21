<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\Member_model';

    public function index()
    {
        return $this->respond($this->model->findAll(), 200);
    }

    //新增的api //POST
    public function create()
    {
        // $validation =  \Config\Services::validation();

        $name   = $this->request->getPost('name');
        $ename = $this->request->getPost('ename');
        $phone = $this->request->getPost('phone');
        $email = $this->request->getPost('email');
        $sex = $this->request->getPost('sex');
        $city = $this->request->getPost('city');
        $township = $this->request->getPost('township');
        $postcode = $this->request->getPost('postcode');
        $address = $this->request->getPost('address');
        $notes = $this->request->getPost('notes');

        $data = [
            'name' => $name,
            'ename' => $ename,
            'phone' => $phone,
            'email' => $email,
            'sex' => $sex,
            'city' => $city,
            'township' => $township,
            'postcode' => $postcode,
            'address' => $address,
            'notes' => $notes,

        ];

        // if($validation->run($data, 'member') == FALSE){
        //     $response = [
        //         'status' => 500,
        //         'error' => true,
        //         'data' => $validation->getErrors(),
        //     ];
        //     return $this->respond($response, 500);
        // } else {
        $insert = $this->model->member_add($data);
        if ($insert) {
            $msg = ['message' => 'Created member successfully'];
            $response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
            return $this->respond($response, 200);
        }
        // }
    }

    //取單一資料api/ GET
    public function show($id = NULL)
    {
        $get = $this->model->get_by_id($id);
        if ($get) {
            $response = [
                'status' => 200,
                'error' => false,
                'data' => $get,
            ];
            return $this->respond($response, 200);
        } else {
            $msg = ['message' => 'Not Found'];
            $response = [
                'status' => 404,
                'error' => false,
                'data' => $msg,
            ];
        }
    }

    //修改api //PUT
    public function update($id = NULL)
    {
        //$validation =  \Config\Services::validation();
        // $name   = $this->request->getRawInput('name');
        // $ename = $this->request->getRawInput('ename');
        // $phone = $this->request->getRawInput('phone');
        // $email = $this->request->getRawInput('email');
        // $sex = $this->request->getRawInput('sex');
        // $city = $this->request->getRawInput('city');
        // $township = $this->request->getRawInput('township');
        // $postcode = $this->request->getRawInput('postcode');
        // $address = $this->request->getRawInput('address');
        // $notes = $this->request->getRawInput('notes');
        $data = $this->request->getRawInput();

        // $data = [
        //     'name' => $name,
        //     'ename' => $ename,
        //     'phone' => $phone,
        //     'email' => $email,
        //     'sex' => $sex,
        //     'city' => $city,
        //     'township' => $township,
        //     'postcode' => $postcode,
        //     'address' => $address,
        //     'notes' => $notes,
        // ];
        // if($validation->run($data, 'member') == FALSE){
        //     $response = [
        //         'status' => 500,
        //         'error' => true,
        //         'data' => $validation->getErrors(),
        //     ];
        //     return $this->respond($response, 500);
        // } else {
        $update = $this->model->member_update($data, $id);
        if ($update) {
            $msg = ['message' => 'Updated member successfully'];
            $response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
            return $this->respond($response, 200);
        }
        // }
    }

}
