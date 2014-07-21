<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class homepage extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('homepage_model');
    }

    public function index() {
        $hData['selectedPage'] = 'index';
        $this->load->view('header', $hData);
        $this->load->view('index');
        $this->load->view('footer');
    }

    public function services() {
        $hData['selectedPage'] = 'sercices';
        $this->load->view('header', $hData);
        $this->load->view('services');
        $this->load->view('footer');
    }

    public function contact() {
        $hData['selectedPage'] = 'contact';
        $this->load->view('header', $hData);
        $this->load->view('contact');
        $this->load->view('footer');
    }

    public function perform() {
        $hData['selectedPage'] = 'perform';
        $this->load->view('header', $hData);
        $this->load->view('perform');
        $this->load->view('footer');
    }

    public function takeMsg() {
        $this->form_validation->set_rules('name', 'Lietotājvārds', 'trim|required|min_length[3]|max_length[254]|xss_clean');
        $this->form_validation->set_rules('msg', 'Ziņa', 'trim|required|min_length[3]|max_length[3000]|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            return;
        }
        $name = $this->input->post("name");
        $msg = $this->input->post("msg");
        $this->homepage_model->save_msg($name, $msg);
        redirect('homepage/services');
    }

    public function offer() {
        $descrition = $this->input->post("description");
        $offer = $this->input->post("offer");
        $name = $this->input->post("name");
        $this->homepage_model->save_msg($name, $descrition, $offer);
    }

}
