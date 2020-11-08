<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {


	public function index(){

		$data['image_path'] = 'images/food_image';

		$this->load->view('menu_items',$data);
	}


	public function login(){

		$this->load->view('auth/login');
	}


	public function resturant_signup(){

		$this->load->view('auth/resturantSignup');
	}


	public function customer_signup(){
		
		$this->load->view('auth/customerSignup');
	}
}
