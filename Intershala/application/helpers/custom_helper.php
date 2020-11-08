<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

    function api_header(){
        header('Access-Control-Allow-Origin: *'); 
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: *');
        header('Content-Type: application/json');
    }


    function remove_space($data){
        foreach($data as $key => $ndata){
            $data->$key = trim($data->$key);
        }

        return $data;
    }



    function authenticate($access = 1){

        $result = authenticate_api($access);

        if($result['errorCode'] == 1270){
            redirect('/login');
        }
        else if($result['errorCode'] == 1271){
            redirect('');
        }
    }



    function authenticate_api($access = 1){

        $ci =& get_instance(); 

        //user_access  1 = user, 2 = resturant
        $user_access = $ci->session->userdata('user_type') ? $ci->session->userdata('user_type') : 0;

        if($user_access == 0){
            return array('status'=>'FAILED','statusCode'=>'401','message'=>'User not Authenticated','errorCode'=>'1270','data'=>'');
        }

        else if($access != $user_access){
            return array('status'=>'FAILED','statusCode'=>'401','message'=>'Unauthorized access','errorCode'=>'1271','data'=>'');
        }

        else if($access == $user_access){
            return array('status'=>'SUCCESS','statusCode'=>'200','message'=>'success','errorCode'=>'0','data'=>'');
        }
    }



    // Use for upload images
    function image_upload($name,$path='food_image'){

        if($name =='' || $name == null){
            return array('status' => 'FAILED','statusCode'=> 402 ,'message' => 'Image Not Found','errorCode'=>'1410','data'=>'');
        }   
       
        $ci =& get_instance();         
        $config['upload_path'] = 'images/'.$path;      
        $config['allowed_types'] = 'gif|jpg|png|jpeg';      
        $config['max_size'] = 6024;            
        $config['maintain_ratio'] = TRUE;      
        $config['remove_spaces'] = TRUE;
        $config['file_name'] = time();        
        $ci->load->library('upload', $config);      
        $ci->upload->initialize($config);

        //find error and return
        if (!$ci->upload->do_upload($name)) {        
            return array('status' => 'FAILED','statusCode'=> 500 ,'message' => $ci->upload->display_errors(),'errorCode'=>'1411','data'=>'');                       
        }

        //upload image       
        $image = $ci->upload->data(); 

        //return image data
        return array('status' => 'SUCCESS','statusCode'=> 200 ,'message' => 'success','errorCode'=>'0','data'=>array('link' =>$path.'/'.$image['file_name'],'path'=>'images/'.$path,'image'=>$image['file_name']));
    }


    function query_format($data){

        $result = array(
            'status'=> 'SUCCESS',
            'statusCode'=> 200,
            'message'=>'success',
            'errorCode'=> 0,
            'rowCount' => count($data),
            'data'=> $data
        );

        return $result;
    }


?>