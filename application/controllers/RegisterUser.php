<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(HLP."/pkg-default.php");
require_once(MOD."/Register/Register.php");

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
	}
	
}