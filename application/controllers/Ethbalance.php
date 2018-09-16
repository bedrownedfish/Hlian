<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ethbalance extends CI_Controller {

	public function __construct(){
		
		parent::__construct();

		$this->load->model('Dbmodel');

		$this->load->model('Publics');

		$this->load->library('session');
		//echo 121;exit;
		$this->load->helper('url');

	}
	public function ethSyns(){

		

	}
}