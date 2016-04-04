<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(LIB."/Message/Message.php");
require_once(MOD."/Register/Register.php");

class Welcome extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->Html = new Html();
		$this->Msg = new Message();
		$this->Register = new Register();
		
	}

	public function index(){
		$params = Array();
		$params['head_start'] = $this->Html->HeadStart();
		$params['body_start'] = $this->Html->BodyStart();
		$params['nav_bar'] = $this->Html->NavBar();	
		$params['msg'] = $this->Msg->GetDefaultMessage();
		$params['signup_html'] = $this->Register->SignupHtml();
		$this->load->view('welcome_message', $params);
	}	
	 
}
