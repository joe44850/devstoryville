<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	

	public function index(){
		$thing['fee'] ="fk";
		$this->load->view('login/default', $thing);
	}	
	 
}