<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class homepage extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('homepage_model');
    }

    public function index($success = "") {
        $hData['selectedPage'] = 'index';
        $this->load->view('header', $hData);
        $data['head_flag'] = $success;
        $this->load->view('index', $data);
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

    public function loadMoreSamples() {
        $i = $this->input->post("record");
        $dirs = scandir('samples');
        sort($dirs);
        $limit = 0;
        for ($i; $i < count($dirs);) {
            if ($dirs[$i] == '.' || $dirs[$i] == '..') {
                continue;
            }
            if ($limit == 9)
                break;
            $i++;
            $limit++;
            $folder = $i - 1;
            $siteDir = scandir('samples/' . $dirs[$folder]);
            foreach ($siteDir as $elem) {
                if ($elem == "img.png" || $elem == "img.jpg" || $elem == "img.jpg") {
                    ?><a href="<?php echo base_url("samples/$dirs[$folder]/src"); ?>"><img class="sample-img" src="<?php echo base_url("samples/$dirs[$folder]/$elem"); ?>" /></a><?php
                }
            }
        }
    }

    public function takeMsg() {
        $config['upload_path'] = './uupl/';
        $config['allowed_types'] = 'gif|jpg|png|doc|docx|rar|zip|pdf|txt|jpeg';
        $config['max_size'] = '3000';
        $this->load->library('upload', $config);
        $this->form_validation->set_rules('name', 'Lietotājvārds', 'trim|max_length[254]|xss_clean');
        $this->form_validation->set_rules('description', 'Ziņa', 'trim|required|min_length[1]|max_length[3000]|xss_clean');
        print_r($this->upload->do_upload('file'));
        if ($this->form_validation->run() === FALSE) {
            redirect('homepage/contact');
        }

        if (!$this->upload->do_upload('file')) {
            echo $this->upload->display_errors();
        } else {
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
        }
        $offer = $this->input->post("offer");
        $name = $this->input->post("name");
        $descrition = $this->input->post("description");
        $this->homepage_model->save_msg($name, $descrition, $offer, $file_name);
        redirect('homepage/index/s');
    }

    public function makeFooter() {
        $dirs = scandir('samples');
        sort($dirs);
        ?> <input type="hidden" id="total_samples" value="<?php echo count($dirs); ?>"><?php
            foreach ($dirs as $dir) {
                if ($dir == '.' || $dir == '..') {
                    continue;
                }


                $siteDir = scandir('samples/' . $dir);
                $myFooter = "<div id =\"homepage_footer\" style=\"
             position: fixed; 
             height: 40px; 
             width: 100%; 
             bottom: 0; 
             background: #CBE32D; 
             text-align: center; 
             padding-top: 12px; 
             cursor: pointer;
             font-size:20px;
             z-index:100;\" onclick=\"window.open('/homepage/homepage/contact', '_self')\">Pieteikties mājāslapas iztrādei</div>";

                foreach ($siteDir as $elem) {
                    $files = scandir("samples/$dir/src");

                    foreach ($files as $file) {
                        $ext = pathinfo($file, PATHINFO_EXTENSION);
                        if ($ext != 'html')
                            continue;
                        $current = file_get_contents("samples/$dir/src/$file");

                        if (!strpos($current, "homepage_footer")) {
                            $pos = strpos($current, "</body>");
                            $current = substr_replace($current, $myFooter, $pos, 0);
                        }
                        file_put_contents("samples/$dir/src/$file", $current);
                    }

                    if ($elem == "img.png" || $elem == "img.jpg" || $elem == "img.jpg") {
                        ?><a alt="homepage sample" href="<?php echo base_url("samples/$dir/src"); ?>"><img class="sample-img" src="<?php echo base_url("samples/$dir/$elem"); ?>"/></a><?php
                }
            }
        }
    }

}
