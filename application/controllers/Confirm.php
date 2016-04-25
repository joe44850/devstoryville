<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(HLP."/pkg-default.php");

class Confirm extends CI_Controller {
	
	public $logged_in;
	public $display_badcode = "none";
	public $is_mobile;
	public $append = "";
	
	public function __construct(){
		parent::__construct();
		$this->is_mobile = isMobile();
		$this->Html = new Html();		
		$this->Login = new Login();
		$this->Login->Attempt();
		$this->Account = new Account($this->Login);
		$this->Register = new Register();
		$this->Message = new Message($this->Account);
		$this->append = ($this->is_mobile) ? "_mobile" : "_pc";		
	}

	public function index(){		
		if(!$this->uri->segment(2)){			
			$this->display_badcode = "none";
			$this->_Nocode(); 
		}
		else $this->_Confirm();
	}
	
	public function resend(){
		$this->load->model("Register/Confirmation");
		$retval = array();
		$email = $_REQUEST['resendemail'];
		if($this->Confirmation->Resend($email, $this->Account)){
			$retval['success'] = true;
			$retval['message'] = "We have sent a new confirmation code to your email: $email";
		}else{
			$retval['success'] = false;
			$retval['message'] = "We could not find $email in our records";
		}
		echo json_encode($retval);
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
		$view_header = "headers/min".$this->append;
		$view_body = "home/home".$this->append;
		$view_footer = "footers/footer".$this->append;
		$this->load->view($view_header, $params);
		$this->load->view($view_body, $params);
		$this->load->view('home/default'.$this->append, $params);
		$this->load->view($view_footer);
	}
	
	private function _Nocode(){
		$this->load->model("Register/Confirmation");		
		$params = Array();
		$params['head_start'] = $this->Html->HeadStart();
		$params['body_start'] = $this->Html->BodyStart();
		$params['nav_bar'] = $this->Html->NavBar();	
		$params['display_badcode'] = $this->display_badcode;
		$view_header = "headers/min".$this->append;
		$view_footer = "footers/footer".$this->append;
		$this->load->view($view_header, $params);
		$this->load->view('login/confirmcodeform', $params);
		$this->load->view($view_footer);
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
