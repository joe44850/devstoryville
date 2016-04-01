<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->Html = new Html();
	}

	public function index(){
		$params = Array();
		$params['head_start'] = $this->Html->HeadStart();
		$params['body_start'] = $this->Html->BodyStart();
		$this->load->view('welcome_message', $params);
	}	
	 
}
