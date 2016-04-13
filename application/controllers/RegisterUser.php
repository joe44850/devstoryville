<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(HLP."/pkg-default.php");

class RegisterUser extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		echo "OK";
	}
	
	public function attempt(){
		echo "Attempting to register";
	}
	
}