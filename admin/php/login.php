<?php
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $output = "";
    $filename = '../json/admin/adminrecord.json';
    if(file_exists($filename)){
        $contant_data = file_get_contents($filename);
        $array_data = json_decode($contant_data,true);
        foreach($array_data as $key => $value){
            if($value['username'] == $username && $value['date_of_birth'] == $password){
                $_SESSION['username'] = $value['admin_name'];
                $output = "success";
            }else{
                $output = "unsuccess";
            }
        }
        file_put_contents($filename,json_encode($array_data,JSON_PRETTY_PRINT));
        echo $output;
    }else{
        echo "Error";
    }
?>