<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(HLP."/pkg-default.php");
require_once(MOD."/Register/Register.php");
require_once(MOD."/Register/Confirmation.php");

class RegisterUser extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->Register = new Register();
	}
	
	public function index(){
		echo "OK";
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