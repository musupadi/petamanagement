<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class login extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Models');
    }
    public function index_post(){
        $username = $this->post('username');
        $password = $this->post('password');
        $where = array(
            'username' => $username,
            'password' => MD5($password)
        );
        $data = $this->Models->getWhere("user",$where);
        if($data){
            $this->response([
                'status' => "success",
                'data' => $data
            ],REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => "failed",
                'data' => $data
            ],REST_Controller::HTTP_OK);
        }
    }
}