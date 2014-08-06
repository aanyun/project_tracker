<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model( 'project', '', TRUE );
    $this->load->model( 'client', '', TRUE );
    $this->load->model( 'user', '', TRUE );
    $this->load->model( 'activities', TRUE );
  }

  function index() {
    if ( $this->session->userdata( 'logged_in' ) ) {
      if($this->session->userdata('isAdmin')==1) {
        $session_data = $this->session->userdata( 'logged_in' );
        $data['username'] = $session_data['username'];
        $data['pageTitle']= "Project Tracker - Ignitorlabs";
        $data['projects'] = $this->project->listAll();
        $data['clients'] = $this->client->listAll();
        $data['projects_json'] = json_encode( $data['projects'] );
        $this->load->view( 'header', $data );
        $this->load->view( 'home_view', $data );
        $this->load->view( 'newProject', $data );
        $this->load->view( 'new_project_success', $data );
        $this->load->view( 'remove_project_confirm', $data );
      } else {
        $this->load->model( 'activities');
        $session_data = $this->session->userdata( 'logged_in' );
        $contact_id = $this->user->getContactId($session_data['username'])->id;
        $data['alert'] = $this->activities->totalAlertbyContact( $contact_id );
        $data['username'] = $session_data['username'];
        $data['projects'] = $this->project->listbyContact($session_data['username']);
        $data['clients'] = $this->client->listAll();
        $data['projects_json'] = json_encode( $data['projects'] );
        $data['pageTitle']= "Project Tracker - Ignitorlabs";
        $this->load->view( 'client/header', $data );
        $this->load->view( 'client/index', $data );
      }
    }
    else {
      //If no session, redirect to login page
      redirect( 'login', 'refresh' );
    }
  }

  function newProject() {
    // var_dump($this->input->post());die();

    $this->load->library( 'form_validation' );
    $this->form_validation->set_rules( 'new_title', 'Project Title', 'trim|required' );
    $this->form_validation->set_rules( 'client', 'Client', 'trim|required' );
    $this->form_validation->set_rules( 'contactList', 'Contact', 'trim|required' );
    
    if ( $this->form_validation->run() == FALSE ) {
      echo validation_errors();
    } else {
      $contact = $this->client->getContactInfo($this->input->post( 'contactList' ));
      $data = array(
        "title"=>$this->input->post( 'new_title' ),
        "desc"=>$this->input->post( 'new_desc' ),
        "start"=>$this->input->post( 'new_start' ),
        "client_id"=>$this->input->post( 'client' ),
        "contact_name"=>$contact->name,
        "contact_email"=>$contact->email,
        "contact_phone"=>$contact->phone,
        "ignitor_name"=>$this->input->post( 'ignitorName' ),
        "ignitor_email"=>$this->input->post( 'ignitorEmail' ),
        "ignitor_phone"=>$this->input->post( 'ignitorPhone' )
      );

      $projectId = $this->project->createNew( $data );
      // die();
      if ( !empty( $projectId ) ) {
        $this->load->model( 'task' );

        foreach ( $_POST as $name => $value ) {
          if ( strpos( $name, "Chk" ) !== FALSE ) {
            $newtask = array(
              "project_id"=>$projectId,
              "task_id"=>$value
            );
            if ( !empty( $this->input->post( 'instLessQty' ) ) && $value == 4) {
                for ( $i=0; $i < $this->input->post( 'instLessQty' ); $i++ ) {
                  $newtask = array(
                    "project_id"=>$projectId,
                    "task_id"=>4
                  );
                  $this->task->createNew($newtask);
                }
            } else if(!empty($this->input->post( 'flLessQty' ) ) && $value == 15) {
               for ( $i=0; $i < $this->input->post( 'flLessQty' ); $i++ ) {
                $newtask = array(
                  "project_id"=>$projectId,
                  "task_id"=>15
                );
                $this->task->createNew( $newtask );
              }
            } else
            $this->task->createNew( $newtask );
          }

        }
        // var_dump($this->input->post( 'instLessQty' ));die;




        

        echo "Success".$projectId;
      } else
        echo "Insert Error";

    }
  }

  public function client() {
    $session_data = $this->session->userdata( 'logged_in' );
    $data['username'] = $session_data['username'];
    $data['projects'] = $this->project->listAll();
    $data['clients'] = $this->client->listAll();
    $data['projects_json'] = json_encode( $data['projects'] );
    $data['pageTitle']= "Project Tracker - Ignitorlabs";
    $this->load->view( 'client/header', $data );
    $this->load->view( 'client/index', $data );
  }

  function logout() {
    $this->session->unset_userdata( 'logged_in' );
    session_destroy();
    // var_dump($_SERVER);die();
    redirect( "/login" );
  }

  public function addAtBegining( $projectId ) {

    date_default_timezone_set( 'america/chicago' );
    $taskId = [1, 2, 3];
    for ( $i=0; $i < 3 ; $i++ ) {

      $newtask = array(
        "project_id"=>$projectId,
        "task_id"=>$taskId[$i],
        "start_time"=>date( "Y-m-d H:i:s" )
      );


      $id = $this->activities->createNewTask( $newtask );
      if ( $id >= 0 ) {
        $data = array(
          "id_project_task"=>$id,
          "status_id"=>"2",
          "start_time"=>date( "Y-m-d H:i:s" ),
          "file_url"=>$url,
          "description"=>"",
          "sub_name"=>""
        );

        if ( $this->activities->createNew( $data ) ) echo "Success";
      }

    }

  }

  public function clients() {
    $this->load->library( 'form_validation' );
    $this->form_validation->set_rules( 'clientName', 'Client', 'trim|required' );
    $this->form_validation->set_rules( 'contactName', 'Contact Name', 'trim|required' );
    $this->form_validation->set_rules( 'contactPhone', 'Phone Number', 'trim|required' );
    $this->form_validation->set_rules( 'contactEmail', 'Contact Email', 'trim|required' );

    if ( $this->form_validation->run() == FALSE ) {
      echo validation_errors();
    } else {
      $data = array(
        "title"=>$this->input->post( 'new_title' ),
        "start"=>$this->input->post( 'new_start' ),
        "client_id"=>$this->input->post( 'client' )
      );

      $projectId = $this->project->createNew( $data );

      if ( !empty( $projectId ) ) {
        // $this->addAtBegining($projectId);
        echo "Success";
      } else
        echo "Insert Error";

    }
  }

  public function task($id)
  {
      $this->load->model( 'task');
      if ( $this->session->userdata( 'logged_in' ) ) {
      $session_data = $this->session->userdata( 'logged_in' );
      $data['username'] = $session_data['username'];
      $data['pageTitle']= "Project Tracker - Ignitorlabs";
      $data['project'] = $this->project->get($id);
      $data['projects'] = $this->project->listAll();
      $data['clients'] = $this->client->listAll();
      $data['tasks'] = $this->task->getProjectTaskList($id);
      $data['projects_json'] = json_encode( $data['projects'] );
      $data['projectId'] = $id;
      $this->load->view( 'header', $data );
      $this->load->view(  'task_description', $data);
      $this->load->view( 'newProject', $data );
      $this->load->view( 'remove_task_confirm', $data );
    }
    else {
      //If no session, redirect to login page
      redirect( 'login', 'refresh' );
    }
  }

  public function getTask($department){
    $this->load->model( 'task');
    echo json_encode($this->task->get("d_id=".$department));
  }


}

?>
