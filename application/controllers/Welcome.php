<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(LIB."/Message/Message.php");

class Welcome extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->Html = new Html();
		$this->Msg = new Message();
	}

	public function index(){
		$params = Array();
		$params['head_start'] = $this->Html->HeadStart();
		$params['body_start'] = $this->Html->BodyStart();
		$params['nav_bar'] = $this->Html->NavBar();	
		$params['msg'] = $this->Msg->GetDefaultMessage();
		$this->load->view('welcome_message', $params);
	}	
	 
}
