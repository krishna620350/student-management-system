<?php
    include "../../config.php";
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: {$host}/php/login.html");
    }
    $deleterecord = $_GET['delete'];
    $class = $_GET['class'];
    // echo $deleterecord." ".$class;
    
    $filename = '../../../json/class'.$class.'/studentRecord-'.$class.'.json';
    // echo $filename;
    $array_data_index = array();
    if(file_exists($filename)){
        $contant_data = file_get_contents($filename);
        $array_data = json_decode($contant_data,true);
        foreach($array_data as $key => $value){
            if($value['id'] == $deleterecord){
                unlink("../../../json/class{$value['class']}/upload/{$value['image_name']}");
                $array_data_index[] = $key;
            }
        }
        foreach($array_data_index as $i){
            unset($array_data[$i]);
        }
        $array_data = array_values($array_data);
        if(file_put_contents($filename,json_encode($array_data,JSON_PRETTY_PRINT))){
            header("Location: {$host}/php/student/html/displayrecord.html?class={$class}");
        }
    }
?>