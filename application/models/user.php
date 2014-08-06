<?php
Class User extends CI_Model
{
 function login($username, $password)
 {
   $this -> db -> select('id, username, password');
   $this -> db -> from('users');
   $this -> db -> where('username', $username);
   $this -> db -> where('password', MD5($password));
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }

public function isAdmin($username)
{
  $q = $this->db->get_where('users', ['username'=>$username]);
  return $q;
}
public function createNewUser($username,$password,$role){
  $data = array(
    "username"=>$username,
    "password"=>MD5($password),
    "role"=>$role
    );
  $this->db->insert('users', $data); 
}
function user_exists($email)
{
    $this->db->where('username',$email);
    $query = $this->db->get('users');
    if ($query->num_rows() > 0){
        return true;
    }
    else{
        return false;
    }
}
function getContactId($email){
  $this->db->where('email',$email);
  $query = $this->db->get('contact');
  return $query->first_row();
}

}
?>