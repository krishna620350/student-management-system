<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: {$host}/php/html/login.html");
}
$name = $_POST['rname'];
$fname = $_POST['rfname'];
$mname = $_POST['rmname'];
$dob = $_POST['rdate'];
$class = $_POST['rclassname'];
$adhar = $_POST['radhar'];
$email = $_POST['remail'];
$phone = $_POST['rphone'];

$filename = '../admin/json/class'.$_SESSION['class']. '/studentcorrectionrequest.json';
$filename_1 = '../admin/json/class'.$_SESSION['class'].'/studentRecord-'.$_SESSION['class'].'.json';
$array_data_1 = json_decode(file_get_contents($filename_1),true);
$array_data = json_decode(file_get_contents($filename),true);
$new_array = array();
$result = 0;
foreach($array_data_1 as $key => $value){
    $new_array = array(
        'id' => $value['id']
    );
    if($value['student_name']!=$name){
        $new_array[] = array(
            'student_name' => $name
        );
        $result = 1;
    }if($value['father_name']!=$fname){
        $new_array[] = array(
            'father_name' => $fname
        );
        $result = 1;
    }if($value['mother_name']!=$mname){
        $new_array[]= array(
            'mother_name' => $mname
        );
        $result = 1;
    }if($value['date_of_birth']!=$dob){
        $new_array[] = array(
            'date_of_birth' => $dob
        );
        $result = 1;
    }if($value['adhar_number']!=$adhar){
        $new_array[] = array(
            'adhar_number' => $adhar
        );
        $result = 1;
    }if($value['email_id']!=$email){
        $new_array = array(
            'email_id' => $email
        );
        $result = 1;
    }if($value['phone_number']!=$phone){
        $new_array[] = array(
            'phone_number' => $phone
        );
        $result = 1;
    }
}
$array_data[] = $new_array;
file_put_contents($filename_1,json_encode($array_data_1,JSON_PRETTY_PRINT));
file_put_contents($filename,json_encode($array_data,JSON_PRETTY_PRINT));
if($result == 1){
    echo '<h3 style="text-align: center;padding:10px;background-color:green;margin-top:10%;color:black;">Applied-Successfully</h3>';
}else{
    echo '<h3 style="text-align: center;padding:10px;background-color:red;margin-top:10%;color:black;">No correction detected</h3>';
}
?>