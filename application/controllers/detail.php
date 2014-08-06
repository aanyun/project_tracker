<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
    define('DAY_WORK', 32400); // 9 * 60 * 60
    define('HOUR_START_DAY', '08:00:00');
    define('HOUR_END_DAY', '17:00:00');
class Detail extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('project','',TRUE);
    $this->load->model('activities','',TRUE);
    $this->load->model('task','',TRUE);
    $this->load->model('client','',TRUE);
  }

  function index($id = NULL)
  { 
    if($this->session->userdata('logged_in'))
    {
    	date_default_timezone_set('america/chicago');
    	$session_data = $this->session->userdata('logged_in');
    	$data['username'] = $session_data['username'];
    	$data['project'] = $this->project->get($id);
      //if project doesn't exist
      if($data['project']==''||is_null($data['project'])||!array_key_exists('id', $data['project'])) redirect('../home');

      $data['contact'] = $this->client->getPrimaryContact($id);
    	$data['activities_raw'] = $this->activities->get($id);
    	$data['start_time'] = (array_key_exists(0,$data['activities_raw']))?$data['activities_raw'][0]->start_time:'';
    	$data['Instructional_admin_tasks'] = $this->task->get('d_id = 1');
    	$data['d_admin_tasks'] = $this->task->get('d_id = 2');
    	$data['flash_admin_tasks'] = $this->task->get('d_id = 3');
    	$data['project_id'] = $id;

      $project_tasks_data = $this->task->getProjectTaskList($id);
      //print_r($project_tasks_data);
      $data['project_tasks_data'] = $project_tasks_data;

      $alert = 0;
      $elapsedTime = 0;
      
    	$project_tasks = array();
    	foreach($data['activities_raw'] as $key=>$value){
        if($value->status_name!="Completed"&&$value->task_id!=1&&$value->task_id!=2&&$value->task_id!=3){
          //$diff = date_diff(date_create($value->start_time),date_create($value->end_time));
        $elapsedTime = $elapsedTime + $this->test($value->start_time,$value->end_time);
      }
        if($value->end_time == null && $value->isClient ==0 && $value->feedback_required == 1) $alert++;
    		$project_tasks[$value->id_project_task][] = $value;
    	}
      $data['elapsedTime'] = floor($elapsedTime/60);
    	$data['activities'] = $project_tasks;
      $data['alert'] = $alert;
      if($this->session->userdata('isAdmin')==1) {
        $data['tasks'] = $this->task->adminList();
      } else {
        $data['tasks'] = $this->task->clientList();
      }
      
    	$task_status = array();
    	foreach($data['tasks'] as $key=>$value){
    		$task_status[$value->id][] = array(
    			"id"=>$value->status_id,
    			"status"=>$value->status_name
    			);
    	}

      //progress bar data collect
      $counter = array(0,0,0);
    	$totalTasks = count($project_tasks_data);
      foreach($project_tasks_data as $val){
        if($val->d_id == 1&&$val->end_time!=null) $counter[0]++;
        if($val->d_id == 2&&$val->end_time!=null) $counter[1]++;
        if($val->d_id == 3&&$val->end_time!=null) $counter[2]++;
      }

      $counter_total = array(0,0,0);
      foreach($project_tasks_data as $val){
        if($val->d_id == 1) $counter_total[0]++;
        if($val->d_id == 2) $counter_total[1]++;
        if($val->d_id == 3) $counter_total[2]++;
      }

      $data['overallprogress'] = round((($counter[0]+$counter[1]+$counter[2])/$totalTasks)*100,2);
      if($counter_total[0]!=0) $data['instructionalprogress'] = round(($counter[0]/$counter_total[0])*100,2); else $data['instructionalprogress']=0;
      if($counter_total[1]!=0) $data['threeDprogress'] = round(($counter[1]/$counter_total[1])*100,2); else $data['threeDprogress'] =0;
      if($counter_total[2]!=0) $data['flashprogress'] = round(($counter[2]/$counter_total[2])*100,2); else $data['flashprogress']=0;
      $data['counter'] = $counter;
      $data['counter_total'] = $counter_total;
      $data['totalTasks'] = $totalTasks;
    	// $data['totalCurrentTasks'] = count($project_tasks);

    	$data['task_status'] = $task_status;


      if($this->session->userdata('isAdmin')==1) {
        $data['isAdmin'] = 1;
        $this->load->view('html_header',$data);
        $this->load->view('newTaskforDept1', $data);
        $this->load->view('newTaskforDept2', $data);
        $this->load->view('newTaskforDept3', $data);
        $this->load->view('header',$data);
        $this->load->view('project_info',$data);
        $this->load->view('project_view', $data);
        $this->load->view('project_history_table', $data);
        $this->load->view('task', $data);
        $this->load->view('html_footer',$data);
      } else {
        $data['isAdmin'] = 0;
        $this->load->view('html_header',$data);
        $this->load->view('client/header',$data);
        $this->load->view('project_info',$data);
        $this->load->view('client/project_view', $data);
        $this->load->view('project_history_table', $data);
        $this->load->view('client/task', $data);
        $this->load->view('client/html_footer',$data);
      }

      }
    else
    {
      //If no session, redirect to login page
      redirect('login', 'refresh');
  }
 
  }

  function test($date_begin,$date_end){

    //ini_set('display_errors', 'on');


    // get begin and end dates of the full period
    //$date_begin = '2014-07-31 09:00:00';
    //$date_end = '2014-07-31 13:00:00';

    // keep the initial dates for later use
    $d1 = new DateTime($date_begin);
    $d2 = new DateTime($date_end);

    // and get the datePeriod from the 1st to the last day
    $period_start = new DateTime($d1->format('Y-m-d 00:00:00'));
    $period_end   = new DateTime($d2->format('Y-m-d 23:59:59'));
    $interval = new DateInterval('P1D');
    //$interval = new DateInterval('weekdays'); // 1 day interval to get all days between the period
    $period = new DatePeriod($period_start, $interval, $period_end);

    $worked_time = 0;
    $nb = 0;
    // for every worked day, add the hours you want
    foreach($period as $date){
      $week_day = $date->format('w'); // 0 (for Sunday) through 6 (for Saturday)
      if (!in_array($week_day,array(0, 6)))
      { 
        // if this is the first day or the last dy, you have to count only the worked hours 
        if ($date->format('Y-m-d') == $d1->format('Y-m-d'))
        {  
          if($date->format('Y-m-d') == $d2->format('Y-m-d')) {
            $diff = $d2->diff($d1)->format("%H:%I:%S");
            $diff = explode(':', $diff);
            $diff = $diff[0]*3600 + $diff[1]*60 + $diff[0];
            $worked_time += $diff;
          } else {
            $end_of_day_format = $date->format('Y-m-d '.HOUR_END_DAY);
            $d1_format = $d1->format('Y-m-d H:i:s');
            $end_of_day = new DateTime($end_of_day_format);
            $diff = $end_of_day->diff($d1)->format("%H:%I:%S");
            $diff = explode(':', $diff);
            $diff = $diff[0]*3600 + $diff[1]*60 + $diff[0];
            $worked_time += $diff;
          }
        }
        else if ($date->format('Y-m-d') == $d2->format('Y-m-d'))
        { 
            $start_of_day = new DateTime($date->format('Y-m-d '.HOUR_START_DAY));
            $d2_format = $d2->format('Y-m-d H:i:s');
            $end_of_day = new DateTime($end_of_day_format);
            $diff = $start_of_day->diff($d2)->format('%H:%I:%S');
            $diff = explode(':', $diff);
            $diff = $diff[0]*3600 + $diff[1]*60 + $diff[0];
            $worked_time += $diff;
        }
        else
        { 
            // otherwise, just count the full day of work
            $worked_time += DAY_WORK;
        }
        }
        if ($nb> 10)
          die("die ".$nb);
      }
      return $worked_time/60;
  }

  
}

?>