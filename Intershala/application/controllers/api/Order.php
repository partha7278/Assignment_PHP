<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {


    public function __construct(){

		parent::__construct();
        api_header();
	}


	public function add(){
        
        $auth = authenticate_api(1);
        if($auth['statusCode'] != 200){
            return print_r(json_encode($auth));
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if(isset($data->data)){
		    $data = remove_space($data->data);
        }

        //item_id validate
		if(!($data->item_id && $data->item_id > 0)){
			print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>'Invalid Item ID','errorCode'=>'1671','data'=>'')));
			return;
        }

        //fetch item
        $item  = $this->db->select('id,price,offer_price')->from('food_item')->where('id',$data->item_id)->where('status',1)->get()->result();
        if(count($item) == 0 ){
            print_r(json_encode(array('status'=>'FAILED','statusCode'=>'402','message'=>'Wrong Item ID','errorCode'=>'1672','data'=>'')));
			return;
        }

        $price = $item[0]->price;
        if($item[0]->offer_price != 0){
            $price = $item[0]->offer_price;
        }

        $mdata = array(
            'user_id'=> $this->session->userdata('user_id'),	
            'food_item_id'=>$data->item_id,
            'price'=> $price,
            'status'=> 1,
			'created_at'=> date('Y-m-d H:i:s', time()),
			'updated_at' => date('Y-m-d H:i:s', time())
        );
        $this->db->insert('orders',$mdata);
		$id = $this->db->insert_id();

		//colleaction order data
		$order = array('food_item_id'=> $data->item_id,'price'=> $item[0]->price,'order_id'=>$id);

		print_r(json_encode(array('status'=>'SUCCESS','statusCode'=>'200','message'=>'success','errorCode'=>'0','data'=> $order)));
		return;
    }



    public function viewby_user(){

        $auth = authenticate_api(2);
        if($auth['statusCode'] != 200){
            return print_r(json_encode($auth));
        }

        //owner user_id
        $user_id = $this->session->userdata('user_id');

        $result = $this->db->select('o.id,f.name,o.price,o.updated_at,u.name as user_name,u.email')->from('orders o')->join('food_item f','o.food_item_id = f.id','left')->join('users u','o.user_id = u.id','left')->where('o.status',1)->where('f.user_id',$user_id)->get()->result();
        $data = query_format($result);

        print_r(json_encode($data));
        return;
    }
}