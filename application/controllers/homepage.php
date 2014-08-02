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
        $this->form_validation->set_rules('name', 'Lietotājvārds', 'trim|max_length[254]|xss_clean');
        $this->form_validation->set_rules('description', 'Ziņa', 'trim|required|min_length[1]|max_length[3000]|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            redirect('homepage/contact');
        }
        $offer = $this->input->post("offer");
        $name = $this->input->post("name");
        $descrition = $this->input->post("description");
        $this->homepage_model->save_msg($name, $descrition, $offer);
       redirect('homepage/index');
    }

}
