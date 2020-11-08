<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

    public function __construct(){
		parent::__construct();
		authenticate(2);
	}


	public function index(){

        $data['title'] = 'All Orders';

		$this->load->view('resturant/orders/view',$data);
	}

}
