<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {


    public function __construct(){

		parent::__construct();
        api_header();
	}


	public function add(){
        
        $auth = authenticate_api(2);
        if($auth['statusCode'] != 200){
            return print_r(json_encode($auth));
        }

        //image upload & return of any error found
        $result = image_upload('file');
        if($result['statusCode'] == 500 || $result['statusCode'] == 402){
            print_r(json_encode($result));
		 	return;
        }

        //name length validate
		if(strlen($this->input->post('name')) < 4){
			print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>'Name atleast 4 character','errorCode'=>'1571','data'=>'')));
			return;
        }
        
        
        //price validate
        if(!preg_match('/[^0-9]*$/i', $this->input->post('price'))){
            print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>'Invalid Price','errorCode'=>'1572','data'=>'')));
			return;
        }

        //offer price 
        $offer_price = $this->input->post('offer_price') ? $this->input->post('offer_price') : 0;
        //offer price validate
        if(!preg_match('/[^0-9]*$/i', $offer_price)){
            print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>'Invalid Offer Price','errorCode'=>'1573','data'=>'')));
			return;
        }

        //food type validate
        if(!($this->input->post('foodType') == 'veg' || $this->input->post('foodType') == 'nonveg')){
            print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>'Invalid Food Type','errorCode'=>'1076','data'=>'')));
            return;
        }

		

		$mdata = array(
            'name'=> $this->input->post('name'),
            'image' => $result['data']['image'],
			'price'=> $this->input->post('price'),
			'offer_price'=> $offer_price,
			'details'=> $this->input->post('details'),
            'food_type'=> $this->input->post('foodType'),
            'user_id' => $this->session->userdata('user_id'),
			'status'=> 1,
			'created_at'=> date('Y-m-d H:i:s', time()),
			'updated_at' => date('Y-m-d H:i:s', time())
		);
		$this->db->insert('food_item',$mdata);
		$id = $this->db->insert_id();

		//colleaction food data
		$food = array('food_item_id'=>$id,'name'=> $this->input->post('name'),'image' => $result['data']['image'],'price'=> $this->input->post('price'),'offer_price'=> $offer_price,'details'=> $this->input->post('details'),'food_type'=> $this->input->post('foodType'));

		print_r(json_encode(array('status'=>'SUCCESS','statusCode'=>'200','message'=>'success','errorCode'=>'0','data'=> $food)));
		return;
    }
    


    public function viewby_user(){

        $auth = authenticate_api(2);
        if($auth['statusCode'] != 200){
            return print_r(json_encode($auth));
        }

        $user_id = $this->session->userdata('user_id');

        $result = $this->db->select('id,name,image,price,offer_price,food_type,updated_at')->from('food_item')->where('status',1)->where('user_id',$user_id)->get()->result();
        $data = query_format($result);

        print_r(json_encode($data));
        return;
    }



    public function all_items(){

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if(isset($data->data)){
		    $data = remove_space($data->data);
        }

        $this->db->select('f.id,f.name,f.image,f.price,f.offer_price,f.food_type,r.name as resturant')->from('food_item f')->join('users r','f.user_id = r.id','left')->where('f.status',1);
        if($data->food_type == 'veg' || $data->food_type == 'nonveg'){
            $this->db->where('f.food_type',$data->food_type);
        }
        $result = $this->db->get()->result();
        $data = query_format($result);

        print_r(json_encode($data));
        return;
    }


    
}
