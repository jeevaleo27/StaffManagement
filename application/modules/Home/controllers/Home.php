<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller 
{

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('email');

	}
	/*@Desc:Function to load a Dashboadrd page @Author:Jeeva*/
	public function index()
	{
		$d["content"]="Dashboard";
		$this->load->view("page.php",$d);

	}
}
