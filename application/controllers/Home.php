<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(HLP."/pkg-default.php");

class Home extends CI_Controller {
	
	public $logged_in;
	public $display_badcode = "none";
	public $is_mobile = false;
	public $append = "";
	
	
	public function __construct(){
		parent::__construct();
		$this->is_mobile = isMobile();
		$this->Html = new Html();		
		$this->Login = new Login();
		$this->logged_in = $this->Login->Attempt();
		$this->Account = new Account($this->Login);
		$this->Register = new Register();
		$this->Message = new Message($this->Account);
		$this->append = ($this->is_mobile) ? "_mobile" : "_pc";
	}

	public function index(){
		if(!$this->logged_in){
			return $this->splash();
		}
		$params = Array();
		$params['head_start'] = $this->Html->HeadStart();
		$params['body_start'] = $this->Html->BodyStart();
		$params['nav_bar'] = $this->Html->NavBar();
		$params['msg'] = $this->Message->Home();
		$params['main_html'] = $this->_MainHTML();
		$view_header = "headers/header".$this->append;
		$view_body = "home/home".$this->append;
		$view_footer = "footers/footer".$this->append;
		$this->load->view($view_header, $params);
		$this->load->view($view_body, $params);
		if(!$this->Login->is_logged_in){ $this->load->view("register/register".$this->append);}
		$this->load->view($view_footer, $params);
	}
	
	public function splash(){
		$params['head_start'] = $this->Html->HeadStart();
		$params['body_start'] = $this->Html->BodyStart();
		$view_footer = "footers/footer".$this->append;
		$view = "home/splash".$this->append;
		$this->load->view($view, $params);
		$this->load->view($view_footer);
	}
	
	public function loginAttempt(){
		$username = $_POST['username'];
		$pwd = $_POST['pwd'];
		$result = array("success"=>false, "username"=>$username, "pwd"=>$pwd);
		$result["success"] = $this->Login->Attempt($username, $pwd);
		$json = json_encode($result);
		echo $json;
	}
	
	public function login(){
		$base = BASE;
		if($this->logged_in){ header("location: $base");}
		
		$params = Array();
		$params['head_start'] = $this->Html->HeadStart();
		$params['body_start'] = $this->Html->BodyStart();
		$params['logo_header'] = $this->Html->LogoHeader();
		$view_header = "headers/header".$this->append;
		$view_body = "login/default".$this->append;
		$view_footer = "footers/footer".$this->append;
		$this->load->view($view_header, $params);
		$this->load->view($view_body, $params);
		$this->load->view($view_footer, $params);
	}
	
	public function logout(){
		$base = BASE;
		$this->Login->Logout();
		
		$params = Array();
		$params['head_start'] = $this->Html->HeadStart();
		$params['body_start'] = $this->Html->BodyStart();
		$params['logo_header'] = $this->Html->LogoHeader();		
		$view_header = "headers/header".$this->append;
		$view_body = "login/logout".$this->append;
		$view_footer = "footers/footer".$this->append;
		$this->load->view($view_header, $params);
		$this->load->view($view_body, $params);
		$this->load->view($view_footer, $params);
	}

	private function _MainHTML(){
		if($this->Login->is_logged_in){
			return $this->_displayUserPage();
		}
		else return $this->Register->SignupHTML();
	}
	
	private function _displayUserPage(){
		$html =  $this->Html->GetSubMenu();		 
		return $html;
	}
	 
}
