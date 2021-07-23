<?php
    session_start();
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    $result = 0;
    for($i=1;$i<=12;$i++){
        $filename = '../admin/json/class'.$i.'/studentRecord-'.$i.'.json';
        if(file_exists($filename)){
            $array_data = json_decode(file_get_contents($filename),true);
            if(!empty($array_data)){
                foreach($array_data as $key => $value){
                    if($value['id'] == $userid && $value['date_of_birth'] == $password){
                        $_SESSION['username'] = $value['student_name'];
                        $_SESSION['id'] = $value['id'];
                        $_SESSION['class'] = $value['class'];
                        $result = 1;
                        break;
                    }
                }
            }
            file_put_contents($filename,json_encode($array_data,JSON_PRETTY_PRINT));
        }
    }
    echo $result;
?>