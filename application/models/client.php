
<?php
Class Client extends CI_Model
{
  function listAll()
  {
    $query = $this->db->query('select * from client');
    return $query->result();

  }
  function createNew($data)
  {

  	$this->db->insert('client',$data);
    
    return $this->db->insert_id();

  }

   function newContact($data)
  {

  	$this->db->insert('contact',$data);
    
    return $this->db->insert_id();

  }
     function getContactInfo($id)
  {

    $query = $this->db->query('select * from contact where id='.$id);
    return $query->first_row();

  }

  function getPrimaryContact($project_id)
  {

    $query = $this->db->query('select * from vwproject where id='.$project_id);
    return $query->first_row();
  }
 
   function updatePrimaryContact($data,$id)
   {
    $this->db->where('id', $id);
    return $this->db->update('project', $data); 
   }
  
  public function contacts($clientId){
    return $this->db->get_where('contact', ['client_id'=>$clientId]);
  }

}
?>

