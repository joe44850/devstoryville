<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(HLP."/pkg-default.php");
require_once(MOD."/Register/Register.php");
require_once(MOD."/Register/Confirmation.php");

class RegisterUser extends CI_Controller {
	
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
		$base = BASE;
		if($this->logged_in){ header("location: $base");}
		
		$params = Array();
		$params['head_start'] = $this->Html->HeadStart();
		$params['body_start'] = $this->Html->BodyStart();
		$params['logo_header'] = $this->Html->LogoHeader();
		$params['logo_header'] = $this->Html->LogoHeader();
		$view_header = "headers/min".$this->append;		
		$view_footer = "footers/footer".$this->append;
		$this->load->view($view_header, $params);		
		$this->load->view("register/register".$this->append);
		$this->load->view($view_footer, $params);
	}
	
	public function attempt(){
		$this->Register->Create($_POST);
		echo $this->Register->CreateResult();
		if($this->Register->User["success"]){
			$user = $this->Register->GetCreatedUser();
			$Confirmation = new Confirmation($user);
			$Confirmation->SendEmail($Confirmation->CreateCode());			
		}
	}
	

	
}