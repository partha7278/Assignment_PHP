<?php

require "redisConnection.php";
require "mysqlConnection.php";



class CacheService{

    function fetch($key){

        //make redis & mysql connection aceessable
        global $redis;
        global $conn;

        
        //if exist fetch
        if($redis->exists($key)){
            return json_decode($redis->get($key));
        }
        //else insert in radis
        else{

            //find table & table id
            $table = substr($key,0,strpos($key,":"));
            $id = substr($key,strpos($key,":") + 1);

            //query mysql
            $sql = "SELECT * FROM ".$table." WHERE id=".$id." ";
            $result = $conn->query($sql);
        

            if(is_object($result)){

                //data formating
                $mdata = array();
                $mdata['length'] = $result->num_rows;
                $mdata['data'] = $result->fetch_assoc();
                $mdata['message'] = 'Success';

                //if result found
                if ($result->num_rows > 0) {
                    //insert into radis
                    $redis->set($key, json_encode($mdata));
                }else{
                    $mdata['message'] = 'No data found';
                    $mdata['data'] = array();
                }
 
                return $mdata;
            }
            else{
                return array('length'=>0,'data'=>array(),'message'=>'Something went wrong');
            }
        }

    }
}


?>