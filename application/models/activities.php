<?php
Class Activities extends CI_Model
{

	function get($project_id)
	{
		$query = $this -> db -> query('select * from vwactivities where project_id='.$project_id.' order by id');
		return $query->result();
	}
	function getProjectTasks($project_id)
	{
		$query = $this -> db -> query('select * from project_task where project_id='.$project_id.' order by start_time');
		return $query->result();
	}
	function createNew($data){
		return $this -> db -> insert('activities',$data);
	}
	function createNewTask($data){
		$this -> db -> insert('project_task',$data);
		return $this->db->insert_id();
	}
	function endTask($id_project_task){
		$data = array('end_time'=>date("Y-m-d H:i:s"));
		$this->db->where('id', $id_project_task);
		return $this -> db -> update('project_task',$data);
	}
	function restartTask($id_project_task){
		$data = array('end_time'=>NULL);
		$this->db->where('id', $id_project_task);
		return $this -> db -> update('project_task',$data);
	}
	function startTask($id_project_task){
		$data = array('start_time'=>date("Y-m-d H:i:s"));
		$this->db->where('id', $id_project_task);
		return $this -> db -> update('project_task',$data);
	}
	function endStatus($id){
		$data = array('end_time'=>date("Y-m-d H:i:s"));
		$this->db->where("id=".$id, NULL, FALSE);
		return $this -> db -> update('activities',$data);
	}
	function getCurrentStatus($id_project_task){
		$query = $this->db->query('select * from activities where id_project_task='.$id_project_task." order by id desc");
		return $query->first_row(); 
	
	}
	function getvwCurrentStatus($id_project_task){
		$query = $this->db->query('select * from vwactivities where id_project_task='.$id_project_task." order by id desc");
		return $query->first_row(); 
	
	}
	function getProjectId($id_project_task){
		$query = $this->db->query('select project_id from vwproject_tasks where id='.$id_project_task);
		return $query->first_row()->project_id; 
	}
	function totalAlertbyContact($contact_id){
		$query = $this->db->query('select * from vwactivities,project where vwactivities.end_time is null and vwactivities.feedback_required =1 and project.id = vwactivities.project_id and contact_id='.$contact_id);
		return $query->num_rows(); 
	}
}

?>