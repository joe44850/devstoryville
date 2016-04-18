<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(HLP."/pkg-default.php");

class Confirm extends CI_Controller {
	
	public $logged_in;
	public $display_badcode = "none";
	
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
		if(!$this->uri->segment(2)){			
			$this->display_badcode = "none";
			$this->_Nocode(); 
		}
		else $this->_Confirm();
	}
	
	private function _Confirm(){		
		$this->load->model("Register/Confirmation");
		$confirmed = $this->Confirmation->confirm($this->uri->segment(2));		
		if(!$confirmed){
			$this->display_badcode = "block";			
			return $this->_Nocode();
		}
		$params = Array();
		$params['head_start'] = $this->Html->HeadStart();
		$params['body_start'] = $this->Html->BodyStart();
		$params['nav_bar'] = $this->Html->NavBar();		
		$params['main_html'] = "<div id='main'>Email confirmed, loading login...</div>";
		$params['main_html'].=HTML::OnLoad("CompleteConfirmation()");
		$params['display_badcode'] = $this->display_badcode;
		$params['msg'] = "";
		$this->load->view('welcome_message', $params);
	}
	
	private function _Nocode(){
		$this->load->model("Register/Confirmation");		
		$params = Array();
		$params['head_start'] = $this->Html->HeadStart();
		$params['body_start'] = $this->Html->BodyStart();
		$params['nav_bar'] = $this->Html->NavBar();	
		$params['display_badcode'] = $this->display_badcode;
		$this->load->view('login/confirmcodeform', $params);
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
