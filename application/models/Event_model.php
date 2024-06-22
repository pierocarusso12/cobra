<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    public function get_events() {
        $query = $this->db->get('events');
        return $query->result_array();
    }

    public function add_event($data) {
        $this->db->insert('events', $data);
        return $this->db->insert_id() > 0;  
    }

    public function update_event($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('events', $data);
        return $this->db->affected_rows() > 0;  
    }
    

    public function delete_event($id) {
        $this->db->where('id', $id);
        $this->db->delete('events');
        return $this->db->affected_rows() > 0;  
    }
    

    public function get_all_events() {
        $query = $this->db->get('events');  
        return $query->result_array();
    }

    public function get_event($id) {
        $query = $this->db->get_where('events', array('id' => $id));
        return $query->row_array();
    }

}
