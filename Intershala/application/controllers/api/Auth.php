<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


    public function __construct(){

		parent::__construct();
		$this->hash = 'b98bsa2nla';
		api_header();
	}


	public function register(){

  		$json = file_get_contents('php://input');
		$data = json_decode($json);
		$data = remove_space($data->data);

		//check email vaild or not
		if(!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
			print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>'Email is invalid','errorCode'=>'1071','data'=>'')));
			return;
		}

		//check email already exist or not
		$exist = $this->db->select('id')->from('users')->where('email',$data->email)->get()->num_rows();
		if($exist != 0){
			print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>'Email already registered','errorCode'=>'1072','data'=>'')));
			return;
		}

		//password validate
		if(strlen($data->password) < 8){
			print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>'Password atleast 8 character','errorCode'=>'1073','data'=>'')));
			return;
		}

		//name length validate
		if(strlen($data->name) < 5){
			print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>'Name atleast 5 character','errorCode'=>'1074','data'=>'')));
			return;
		}

		//user_type validate
		if(!($data->user_type == 'customer' || $data->user_type == 'resturant')){
			print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>'Wrong User Type','errorCode'=>'1075','data'=>'')));
			return;
		}


		//for only customer
		if($data->user_type == 'customer'){

			//set user_type for customer
			$data->user_type = 1;

			//food type validate
			if(!($data->food_type == 'veg' || $data->food_type == 'nonveg')){
				print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>'Wrong Food Type','errorCode'=>'1076','data'=>'')));
				return;
			}

			//name validate
			if(!preg_match('/^[a-zA-Z .]*$/i', $data->name)){
				print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>'Invalid Name','errorCode'=>'1077','data'=>'')));
				return;
			}

		}else if($data->user_type == 'resturant'){

			//set user_type for resturant
			$data->user_type = 2;
			//set food_type fot resturant
			$data->food_type = '';
		}

		//set hash password
		$pwd_peppered = hash_hmac("sha256", $data->password, $this->hash);
		$data->password = password_hash($pwd_peppered, PASSWORD_ARGON2ID);

		$mdata = array(
			'name'=> $data->name,
			'email'=> $data->email,
			'password'=> $data->password,
			'user_type'=> $data->user_type,
			'food_type'=> $data->food_type,
			'status'=> 1,
			'created_at'=> date('Y-m-d H:i:s', time()),
			'updated_at' => date('Y-m-d H:i:s', time())
		);
		$this->db->insert('users',$mdata);
		$user_id = $this->db->insert_id();

		//colleaction user data
		$user = array('user_id'=>$user_id,'name'=> $data->name,'email'=> $data->email,'user_type'=> $data->user_type,'food_type'=> $data->food_type);
		//create session
		$this->session->set_userdata($user);

		print_r(json_encode(array('status'=>'SUCCESS','statusCode'=>'200','message'=>'success','errorCode'=>'0','data'=> $user)));
		return;
	}




	public function login(){

		$json = file_get_contents('php://input');
		$data = json_decode($json);
		$data = remove_space($data->data);

		//check email vaild or not
		if(!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
			print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>'Email is invalid','errorCode'=>'1171','data'=>'')));
			return;
		}

		//find user
		$users = $this->db->select('*')->from('users')->where('email',$data->email)->get()->result();
		if(count($users) == 0){
			print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>"User doesn't exist",'errorCode'=>'1172','data'=>'')));
			return;
		}
		
		//create hash password
		$pwd_peppered = hash_hmac("sha256", $data->password, $this->hash);
		if (!password_verify($pwd_peppered, $users[0]->password)) {
			print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>"Wrong Email or Password",'errorCode'=>'1173','data'=>'')));
			return;
		}

		//colleaction user data
		$user = array('user_id'=>$users[0]->id,'name'=> $users[0]->name,'email'=> $users[0]->email,'user_type'=> $users[0]->user_type,'food_type'=> $users[0]->food_type);
		//create session
		$this->session->set_userdata($user);

		print_r(json_encode(array('status'=>'SUCCESS','statusCode'=>'200','message'=>'success','errorCode'=>'0','data'=> $user)));
		return;
	}
    
}
