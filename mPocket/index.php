<?php 
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *'); 

include 'config.php';
include 'mysqlConnection.php';

$fmt = 0;
function dataReturn($mdata,$parmeter){
    return isset($mdata->$parmeter) ? $mdata->$parmeter : false;
} 


function validate($mdata){
    global $fmt,$conn;

    $mids = dataReturn($mdata,'id');
    $fmt = dataReturn($mdata,'fmt');
    $fmt = $fmt ? 1 : 0; 

    $result = array();
    
    if(!$mids){
        $result['message'] = 'Id is required';
        return formating($result);
    }

    $arrids = explode(',',$mids);
    $narr = array();
    foreach($arrids as $ar){
        $n = (int)$ar;
        if($n > 0){
            array_push($narr,$n); 
        }
    }
    $nids = implode(',',$narr);


    $sql = "SELECT email_id,fk_user_id,id,f_name,m_name,l_name FROM  tbl_users WHERE id IN (".$nids.");";
    $result = $conn->query($sql);

    $resultdata = array();
    while($row = $result->fetch_assoc()) {

        array_push($resultdata,$row);
    }
    formating($resultdata,1);
}



function formating($rdata,$res=0){
    global $fmt;

    if($fmt == 0){
        header('Content-Type: application/json');
        if($res == 1){
            $rdata = array('status'=>'SUCCESS','statucCode'=>200,'message'=>'Success','data'=>$rdata);
        }else{
            $rdata = array('status'=>'FAILED','statucCode'=>400,'message'=>$rdata['message'],'data'=>array());
        }
        print_r(json_encode($rdata));
        return;
    }else{
        $result = '';
        if($res==1){
            $result = 'email_id,fk_user_id,id,f_name,m_name,l_name';
            foreach($rdata as $key => $val){
                $result = $result.'\n'.implode(',',$val);
            }
            print_r($result);
            return;
        }else{
            print_r('message\n'.$rdata['message']);
        }
    }
}





$json = file_get_contents('php://input');
$data = json_decode($json);

validate($data);

?>