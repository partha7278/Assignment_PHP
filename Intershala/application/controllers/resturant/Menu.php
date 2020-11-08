<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct(){
		parent::__construct();
		authenticate(2);
	}


	public function index(){

        $data['title'] = 'Menu Items';
        $data['image_path'] = 'images/food_image';

		$this->load->view('resturant/menu/view',$data);
	}


	public function add(){

        $data['title'] = 'Add new Menu Items';

		$this->load->view('resturant/menu/add',$data);
	}
}
