<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

	public function testMain()
	{
		echo 'this is login model';
	}
	
	public function insertUser($data)
	{
		return $this->db->insert("user", $data);
	}
	
	public function fetchUser()
	{
		$this->db->select("*");
		$this->db->from("user");
		$query = $this->db->get();
		return $query;
	}
	
	public function fetchUserById($id)
	{
		$this->db->where("user_id", $id);
		$query = $this->db->get("user");
		return $query;
	} 
	
	public function fetchUserByUsernamePassword($username, $password)
	{
		$this->db->where("username", $username);
		$this->db->where("password", $password);
		$query = $this->db->get("user");
		return $query;
	} 
	
	public function fetchUserByUsername($username)
	{
		$this->db->where("username", $username);
		$query = $this->db->get("user");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return NULL;
		}
		
		return $query;
	} 

	public function updateUser($data, $id)
	{
		$this->db->where("user_id", $id);
		$this->db->update("user", $data);
	}
	
	public function canLogin($username, $password)
	{
		$this->db->where("username", $username);
		if(isset($password)){
			$this->db->where("password", $password);
		}
		$query = $this->db->get("user");

		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	public function canCreateNewUser($username)
	{
		$this->db->where("username", $username);
		$query = $this->db->get("user");

		if($query->num_rows() == 0){
			return true;
		}else{
			return false;
		}
	}
	


}
