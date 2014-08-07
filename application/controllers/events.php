<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Events extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('activities','',TRUE);
    $this->load->model('task','',TRUE);
    $this->load->model('project','',TRUE);
    $this->load->library( 'form_validation' );
  }

  function add(){
    date_default_timezone_set('america/chicago');
    $url = '';
    $file_element_name = 'uploadfile';
    $config['upload_path'] = './files/';
    $config['allowed_types'] = 'zip';
    $config['encrypt_name'] = TRUE;
    
    $this->load->library('upload',$config);
    if ($this->upload->do_upload('uploadfile'))
        {
            $url = $config['upload_path'].$this->upload->data()['file_name'];
            //print_r($url);        
        }
    $newtask = array(
        "project_id"=>$this->input->post('project_id'),
        "task_id"=>$this->input->post('task_select'),
        "start_time"=>date("Y-m-d H:i:s"),
        "desc"=>$this->input->post('desc'),
        "subname"=>$this->input->post('subname')
        );

  	//print_r($data);
  	$this->load->model('activities');
    $id = $this->activities->createNewTask($newtask);
    if($id>=0) {
    $data = array(
        "id_project_task"=>$id,
        "status_id"=>$this->input->post('status_select'),
        "start_time"=>date("Y-m-d H:i:s"),
        "file_url"=>$url
        );

      if($this->activities->createNew($data)) echo "Success";
    }
    
  }

  function addNewTask(){
     $newtask = array(
              "project_id"=>$this->input->post('project_id'),
              "task_id"=>$this->input->post('task_id')
            );
     echo $this->task->createNew( $newtask );
  }

  function startTask(){
    date_default_timezone_set('america/chicago');
    $url = '';
    $file_element_name = 'uploadfile';
    $config['upload_path'] = './files/';
    $config['allowed_types'] = 'zip';
    $config['encrypt_name'] = TRUE;
    
    $this->load->library('upload',$config);
    if ($this->upload->do_upload('uploadfile'))
        {
            $url = $config['upload_path'].$this->upload->data()['file_name'];
            //print_r($url);        
        }
    $this->activities->startTask($this->input->post('project_task_select'));

    if($this->task->isEnd($this->input->post('status_select'))){
      $this->activities->endTask($this->input->post('project_task_select'));
      $data = array(
        "id_project_task"=>$this->input->post('project_task_select'),
        "status_id"=>$this->input->post('status_select'),
        "start_time"=>date("Y-m-d H:i:s"),
        "end_time"=>date("Y-m-d H:i:s"),
        "description"=>$this->input->post('desc'),
        "file_url"=>$url
        );
    } else {
        $data = array(
        "id_project_task"=>$this->input->post('project_task_select'),
        "status_id"=>$this->input->post('status_select'),
        "start_time"=>date("Y-m-d H:i:s"),
        "description"=>$this->input->post('desc'),
        "file_url"=>$url
        );
    }


    if($this->activities->createNew($data)) {
      $this->send_email($this->input->post('project_task_select'));
      echo "Success";
    }
  }


  function newStatus(){
    date_default_timezone_set('america/chicago');
    $url = '';
    $file_element_name = 'uploadfile';
    $config['upload_path'] = './files/';
    $config['allowed_types'] = 'zip';
    $config['encrypt_name'] = TRUE;
    $this->load->library('upload',$config);
    if ($this->upload->do_upload('uploadfile'))
        {
            $url = $config['upload_path'].$this->upload->data()['file_name'];
            //print_r($url);        
        }
    if($this->task->isEnd($this->input->post('status_id'))){
      $this->activities->endTask($this->input->post('id_project_task'));
      $data = array(
        "id_project_task"=>$this->input->post('id_project_task'),
        "status_id"=>$this->input->post('status_id'),
        "start_time"=>date("Y-m-d H:i:s"),
        "end_time"=>date("Y-m-d H:i:s")
        );
    } else {
        $data = array(
        "id_project_task"=>$this->input->post('id_project_task'),
        "status_id"=>$this->input->post('status_id'),
        "start_time"=>date("Y-m-d H:i:s"),
        "description"=>$this->input->post('desc'),
        "file_url"=>$url
        );
    }
    $recentStatus = $this->activities->getvwCurrentStatus($this->input->post('id_project_task'));
    if($recentStatus&&$recentStatus->status_name!="Completed") $this->activities->endStatus($recentStatus->id);
    if($recentStatus&&$recentStatus->status_name=="Completed") $this->activities->restartTask($this->input->post('id_project_task'));

    if($this->activities->createNew($data)) {
      $this->send_email($this->input->post('id_project_task'));
      echo "Success";
    }
  }

  public function history($projectId)
  {
    date_default_timezone_set( "America/Chicago" );
    $r = $this->activities->get($projectId);
    $data = array();
    foreach ($r as $row) {
      switch ($row->department_id) {
        case '1':
            $color = "#B3E39F";
          break;
        case '2':
            $color = "#B5E0F5";
          break;
        case '3':
            $color = "#FCE981";
          break;

      }
      $data[]=["title"=>$row->task_name." ".$row->task_sub_name." - ".$row->status_name, "start"=>$row->start_time , "color"=>$color, "textColor"=>"black"];
      $row->task_name;
      
    }
    if (!is_null($data)) {
      echo json_encode($data);
    }
    
    
  }

  function remove_project($project_id){
    $this->project->remove($project_id);
    redirect( 'home', 'refresh' );
  }
  function remove_task($id_project_task,$project_id){
    $this->task->remove($id_project_task);
    redirect( '../../home/task/'.$project_id, 'refresh' );
  }
  function send_email($id_project_task){
    $project_id = $this->activities->getProjectId($id_project_task);
    $project_info = $this->project->get($project_id);
    $this->load->library('email');
    $config['mailtype'] = 'html';
    $config['charset'] = 'iso-8859-1';
    $config['wordwrap'] = TRUE;

    $this->email->initialize($config); 
    $this->email->from($project_info->ignitor_email, 'Project Tracker System');
    $data = $this->activities->getvwCurrentStatus($id_project_task);
    
//send upadate email to ignitorlabs
    if($data->isClient){       
      $this->email->to($project_info->ignitor_email);  // receiver from ignitorlabs
      $this->email->subject('Client '.$project_info->name.' Update Project Tracker');
      $this->email->message('<div>'.$data->project_name.'</div>
        <div>'.$project_info->contact_name.' from <b>'.$project_info->name.'</b> just update Task :<b>'.$data->task_name.' '.$data->task_sub_name.'</b> status to :</div>
        <div><b>'.$data->status_name.'</b></div>');
      $this->email->send();
      //echo $this->email->print_debugger();
    } else {
//send upadate email to client
      $this->email->to($project_info->contact_email);  // receiver from ignitorlabs
      $this->email->subject('Ignitorlabs make changes to '.$project_info->name);
      $this->email->message('<div>'.$data->project_name.'</div>
        <p>Dear <b>'.$project_info->contact_name.'</b></p>
        <p><b>Ignitorlabs</b> just update Task :<b>'.$data->task_name.' '.$data->task_sub_name.'</b> status to :</div>
        <div><b>'.$data->status_name.'</b></div>');
      $this->email->send();
    }
}

  public function subtitle()
  {
    $rule = $this->form_validation->set_rules( 'taskId', '', 'trim|required' );
    $this->form_validation->set_message("required", 'Please select a task first');
    if ( $this->form_validation->run() == FALSE ) {
      echo validation_errors();
    } else
      echo $this->task->updateTask(["subname"=>$this->input->post("subtitle"), "desc"=>$this->input->post('description')], $this->input->post('taskId'));

  }
  
}

?>