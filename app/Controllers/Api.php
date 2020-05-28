<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

//跨域設置
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}

class Api extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\Member_model';
    public function index()
    {
        // $index = $this->model->findAll();
        $index=$this->model->get_by_id();
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

        $insert = $this->model->member_add($data);
        if ($insert) {
            $response = [
                '200' => "資料新增成功!",
                'data' => $data,
            ];
            return $this->respond($response, 200);
        }
    }

    //取單一資料api/ GET
    public function show($id = NULL)
    {
        $show = $this->model->get_by_id($id);
        if ($show) {
            $response = [
                '200' => '資料載入成功!',
                'data' => $show,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                '404' => '無此筆資料可查詢，請重新操作!',
            ];
            return $this->respond($response, 404);
        }
    }

    //修改api //PUT 
    public function edit($id = NULL)
    {
        //若是用getPost則method要選擇POST
        //若使用getRawIput不用全部欄位都使用，只需要 request->getRawInput即可
        //即會收到使用者更新的資料
        $data = $this->request->getRawInput();
        $update = $this->model->member_update($data,$id);
        if (!$update) {
            $response = [
                '404' => "資料xx!",
            ];
            return $this->respond($response, 404);
        }{
            $response = [
                '200' => "資料修改成功!",
                'data' => $data,
            ];
            return $this->respond($response, 200);
        }
        
    }

    //刪除的api DELETE
    //無此筆資料做刪除的話有判斷示警告
    public function delete($id = NULL)
    {
        $this->model->delete_by_id($id);


        if ($this->model->db->affectedRows() === 1) {
            $response = [
                '200' => '資料已經成功刪除!',
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                '404' => '無此筆資料可刪除，請重新操作!',
            ];
            return $this->respond($response, 404);
        }
    }
}
