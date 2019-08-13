<?php
defined('BASEPATH') OR exit('No direct script access allowed');

public class ParticipantStructure {
	var $participantId;
	var $firstName;
	var $lastName;
	var $emailAddress;
	var $password;

	
	public function __construct()
    {
        parent::__construct();
    }
	
	function set_participantId($participantId = '')
    {
        $this->participantId = $participantId;
    }
	
	function set_firstName($firstName = '')
    {
        $this->firstName = $firstName;
    }

	function set_lastName($lastName = '')
    {
        $this->lastName = $lastName;
    }
	
	function set_emailAddress($emailAddress = '')
    {
        $this->emailAddress = $emailAddress;
    }

	function set_password($password = '')
    {
        $this->password = $password;
    }

}
