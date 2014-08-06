<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clients extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('client');
    $this->load->model('user');
  }

  public function index(){
  	$r = $this->client->listAll();
  	foreach ($r as $key => $row) {
  		$json[$row->id] = $row->name;
  	}
  	echo json_encode($json);
  }

  public function create()
  {
  	
      $this->load->library('form_validation');
      $this->form_validation->set_rules('clientName', 'Client', 'trim|required');
      $this->form_validation->set_rules('contactName', 'Contact Name', 'trim|required');
      $this->form_validation->set_rules('contactPhone', 'Phone Number', 'trim|required');
      $this->form_validation->set_rules('contactEmail', 'Email', 'trim|required|valid_email');

      if($this->form_validation->run() == FALSE)
      {
        echo validation_errors();
      } else {
        $data = array(
          "name"=>$this->input->post('clientName'),
          "note"=>$this->input->post('notes')
          );

        $clientId = $this->client->createNew($data);

        if(!empty($clientId)){
          // $this->addAtBegining($projectId);
           $data = [
           	 "name"=>$this->input->post('contactName'),
          	 "phone"=>$this->input->post('contactPhone'),
          	 "email"=>$this->input->post('contactEmail'),
          	 "client_id"=>$clientId,
           ];

           $contactId = $this->client->newContact($data);
           if(!$this->user->user_exists($this->input->post('contactEmail'))) $this->user->createNewUser($this->input->post('contactEmail'),$this->input->post('contactEmail'),2);
           echo "success";
        } else 
          echo "Insert Error";
       
      }
  }

  function updateContact(){
      $this->load->library('form_validation');
      $this->form_validation->set_rules('name', 'Name', 'trim|required');
      $this->form_validation->set_rules('email', 'Contact Email', 'trim|valid_email|required');
      $this->form_validation->set_rules('phone', 'Contact Email', 'trim|valid_email|required');
      $data = array(
               'contact_name' => $this->input->post('name'),
               'contact_email' => $this->input->post('email'),
               'contact_phone' => $this->input->post('phone'),
            );
      echo $this->client->updatePrimaryContact($data,$this->input->post('id'));
      if(!$this->user->user_exists($this->input->post('email'))){
        $this->user->createNewUser($this->input->post('email'),$this->input->post('email'),2);
      }
  }

  public function contacts($clientId){
      $contacts = $this->client->contacts($clientId);
      foreach ($contacts->result() as $key => $row) {
        $data[$row->id] = $row->name;
      }
      echo json_encode($data);
  }

}


?>