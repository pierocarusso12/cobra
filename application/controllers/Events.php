<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('event_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['events'] = $this->event_model->get_all_events();
        $this->load->view('events/index', $data);
    }

    public function add() {
        $this->form_validation->set_rules('title', 'Título', 'required');
        $this->form_validation->set_rules('start_datetime', 'Hora de Inicio', 'required');
        $this->form_validation->set_rules('end_datetime', 'Hora de Fin', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'errors' => validation_errors()]));
            return;
        }
    
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'start_datetime' => $this->input->post('start_datetime'),
            'end_datetime' => $this->input->post('end_datetime'),
        );
    
        $result = $this->event_model->add_event($data);
    
        $this->output->set_content_type('application/json')->set_output(json_encode(['success' => $result]));
    }
    
    
    
    public function edit() {
        $id = $this->input->post('id');
        
        $this->form_validation->set_rules('title', 'Título', 'required');
        $this->form_validation->set_rules('start_datetime', 'Hora de Inicio', 'required');
        $this->form_validation->set_rules('end_datetime', 'Hora de Fin', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'errors' => validation_errors()]));
            return;
        }
    
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'start_datetime' => $this->input->post('start_datetime'),
            'end_datetime' => $this->input->post('end_datetime'),
        );
    
        $result = $this->event_model->update_event($id, $data);
    
        $this->output->set_content_type('application/json')->set_output(json_encode(['success' => $result]));
    }
    
    
    public function delete() {
        $id = $this->input->post('id');
        $result = $this->event_model->delete_event($id);
    
        $this->output->set_content_type('application/json')->set_output(json_encode(['success' => $result]));
    }
    

    public function getAll() {
        $events = $this->event_model->get_all_events();
        $this->output->set_content_type('application/json')->set_output(json_encode($events));
    }

    public function getOne($id) {
        $event = $this->event_model->get_event($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($event));
    }
}