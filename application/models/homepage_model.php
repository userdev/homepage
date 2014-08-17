<?php

class Homepage_model extends CI_model {

    function __construct() {
        parent::__construct();
    }

    function update_user_info($person) {
        echo $person['person']->sex;
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->update('users', $person['person']);
    }

    function save_msg($username, $msg, $offer = "", $file_url) {
        $data = array(
            'name' => $username,
            'message' => $msg,
            'offer' => $offer,
            'file_url' => $file_url,
            'send' => date("Y-m-d H:i:s")
        );
        $this->db->insert('messages', $data);
    }

    public function get_user_data_by_ID($user_ID) {
        $query = $this->db->select('u.nick, u.email, u.name, u.surname, u.birth, u.sex, u.reg_date, u.job, u.position, u.profession, u.education, u.pic_url, u.city_id, u.country_id, u.adress_line');
        $this->db->from('users u');
        $this->db->where('u.user_id', $user_ID)->limit(1, 0);
        //$this->db->join('countries', 'countries.country_id = u.country_id', 'left');
        $results = $query->get()->result();
        if (count($results) == 0) {//user is found
            $this->username = 0;
        }
        return $results[0];
    }

    public function get_all_countries() {
        $query = $this->db->select('country, country_id');
        $this->db->from('countries');
        $results = $query->get()->result();
        if (count($results) == 0) {//user is found
            $this->country_id = 0;
        }
        return $results;
    }

    public function get_all_cities($country) {
        $query = $this->db->select('city, city_id');
        $this->db->from('cities');
        $this->db->where('country_id', $country);
        $results = $query->get()->result();
        if (count($results) == 0) {//user is found
            $this->city_id = 0;
        }
        return $results;
    }

}
