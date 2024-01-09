<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Kelas extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Models');
    }
    public function index_post(){
        $id_jurusan = $this->post('id_jurusan');
        $program = $this->post('program');
        $class = $this->post('class');
        $where = array(
            'id_jurusan' => $id_jurusan,
            'program' => $program,
            'class' => $class
        );
        $data = $this->Models->getWhere("kelas",$where);
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