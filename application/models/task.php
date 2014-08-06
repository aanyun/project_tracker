<?php
Class Task extends CI_Model
{
	function listAll(){
		$query = $this -> db -> query('select * from vwtask');
    	return $query->result();
	}
	function adminList(){
		$query = $this -> db -> query('select * from vwtask where client=0');
    	return $query->result();
	}
	function clientList(){
		$query = $this -> db -> query('select * from vwtask where client=1');
    	return $query->result();
	}
	function getTaskAdmin($id){
		$query = $this -> db -> query('select * from vwtask where client=0 and id='.$id);
    	return $query->result();
	}
	function get($where){
		  $this->db->from('task');
		  $this->db->where($where, NULL, FALSE); 
		  $query = $this->db->get();
		  return $query->result();
	}
	function isEnd($status_id){
		$query = $this -> db -> query('select end_flag from status where id='.$status_id);
    	$result = $query->row_array();
    	return $result['end_flag'];
	}
	function totalStatus($department_id = NULL){
		if($department_id==null){
			$query = $this->db->query('select id from status');
			return $query->num_rows();
		} else {
			$query = $this->db->query('select id from vwtask where department_id='.$department_id);
			return $query->num_rows();
		}

	}
	function totalTasks($department_id = NULL){
		if($department_id==null){
			$query = $this->db->query('select id from task');
			return $query->num_rows();
		} else {
			$query = $this->db->query('select id from task where d_id='.$department_id);
			return $query->num_rows();
		}

	}

	function getProjectTaskList($project_id){
		$query = $this -> db -> query('select * from vwproject_tasks where project_id='.$project_id);
    	return $query->result();
	}

	function createNew( $data ) {
		return $this -> db -> insert( 'project_task', $data );
	}

	function updateTask($data, $id){
		$this->db->where('id', $id);
		return $this->db->update('project_task', $data);

	}
	function remove($id_project_task){
		$this -> db -> query('delete from project_task where id='.$id_project_task);
	}
}
?>