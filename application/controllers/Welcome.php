<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(HLP."/pkg-default.php");

class Welcome extends CI_Controller {
	
	public $logged_in;
	
	public function __construct(){
		parent::__construct();
		$this->Html = new Html();		
		$this->Login = new Login();
		$this->Login->Attempt();
		$this->Account = new Account($this->Login);
		$this->Register = new Register();
		$this->Message = new Message($this->Account);
	}

	public function index(){
		$params = Array();
		$params['head_start'] = $this->Html->HeadStart();
		$params['body_start'] = $this->Html->BodyStart();
		$params['nav_bar'] = $this->Html->NavBar();
		$params['msg'] = $this->Message->Welcome();
		$params['main_html'] = $this->_MainHTML();		
		$this->load->view('welcome_message', $params);
	}

	private function _MainHTML(){
		if($this->Login->is_logged_in){
			return $this->_displayUserPage();
		}
		else return $this->Register->SignupHTML();
	}
	
	private function _displayUserPage(){
		return "<div>Yay</div>";
	}
	 
}
