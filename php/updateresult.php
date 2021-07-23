<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: {$host}/php/html/login.html");
}
$name = $_POST['rname'];
$dob = $_POST['rdob'];
$text = $_POST['rtext'];
$result = 0;
$filename = '../admin/json/class'.$_SESSION['class']. '/studentcorrectionrequest.json';
$filename_1 = '../admin/json/class'.$_SESSION['class']. '/studentResult-'.$_SESSION['class']. '.json';
$array_data = json_decode(file_get_contents($filename),true);
$array_data_1 = json_decode(file_get_contents($filename_1),true);
$new_array = array();
foreach ($array_data_1 as $key => $value) {
    $new_array = array(
        'id' => $_SESSION['id']
    );
    if($value['student_name']!=$name){
        $new_array[] = array('name' => $name);
        $result =1;
    }if($value['date_of_birth']!=$dob){
        $new_array[] = array('date_of_birth' => $dob);
        $result = 1;
    }else{
        $new_array[] = array(
            'complain' => $text
        );
        $result = 1;
    }
}
$array_data[] = $new_array;
file_put_contents($filename,json_encode($array_data,JSON_PRETTY_PRINT));
if ($result == 1) {
    echo '<h3 style="text-align: center;padding:10px;background-color:green;margin-top:10%;color:black;">Applied-Successfully</h3>';
} else {
    echo '<h3 style="text-align: center;padding:10px;background-color:red;margin-top:10%;color:black;">No correction detected</h3>';
}
?>