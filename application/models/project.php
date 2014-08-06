<?php
Class Project extends CI_Model
{
 function listAll()
 {
    $query = $this -> db -> query('select * from vwproject order by id desc');
    return $query->result();
 }
  function listbyContact($contact_email)
 {
    $query = $this -> db -> query('select * from vwproject where contact_email="'.$contact_email.'"');
    return $query->result();
 }
 function createNew($data)
 {
    $this->db->insert('project',$data);
    return $this->db->insert_id();
 }
 function get($project_id)
 {
    $query = $this -> db -> query('select * from vwproject where id='.$project_id);
	return $query->first_row();
 }
  function remove($project_id)
 {
    $query = $this -> db -> query('delete from project where id='.$project_id);
 }
}
?>