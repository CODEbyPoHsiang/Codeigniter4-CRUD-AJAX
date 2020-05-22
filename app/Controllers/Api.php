<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\Member_model';

    public function index()
    {
        $index=$this->model->findAll();

        if ($index) {
            $response = [
                '200' => '資料載入成功!',
                'data' => $index,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                '404' => '無任何資料!',
            ];
            return $this->respond($response, 404);
        }

        // return $this->respond($this->model->findAll(), 200);
    }

    //新增的api //POST
    public function new()
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
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

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
            $response = [
                '200' => "資料新增成功!",
                'data' => $data,
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
                '200' => '資料載入成功!',
                'data' => $get,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                '404' => '查無此筆資料，操作錯誤!',
            ];
            return $this->respond($response, 404);
        }
    }

    //修改api //PUT //有問題要修改
    public function edit($id = NULL)
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
        // $time = $this->request->getRawInput('updated_at');
  
        // $time = ['updated_at' => date('Y-m-d H:i:s'),];
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
        $update = $this->model->updateMember($data,$id);
        if ($update) {
            $response = [
                '200' => "資料修改成功!",
                'data' => $data,
            ];
            return $this->respond($response, 200);
        }
        
    }

    public function delete($id = NULL)
    {
        $delete = $this->model->delete_by_id($id);
        if ($delete) {
            $code = 200;
            $msg = ['message' => '資料已經成功刪除!'];
            $response = [
                'status' => $code,
                'error' => false,
                'data' => $msg,
            ];
        } else {
            $code = 401;
            $msg = ['message' => '查無資料!'];
            $response = [
                'status' => $code,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response, $code);
    }
}
