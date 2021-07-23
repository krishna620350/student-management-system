<?php
include "../../config.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: {$host}/php/login.html");
}
$sid = $_POST['uid'];
$name = $_POST['uname'];
$fname = $_POST['ufname'];
$mname = $_POST['umname'];
$class = $_POST['uclassname'];
$dob = $_POST['udob'];
$adhar = $_POST['uadhar'];
$email = $_POST['uemail'];
$phone = $_POST['uphone'];

for ($i = 1; $i <= 12; $i++) {
    $filename = '../../../json/class' . $i . '/studentRecord-' . $i . '.json';
    if (file_exists($filename)) {
        $contant_data = file_get_contents($filename);
        $array_data = json_decode($contant_data, true);
        foreach ($array_data as $key => $value) {
            if ($value['id'] == $sid) {
                $array_data[$key]['student_name'] = $name;
                $array_data[$key]['father_name'] = $fname;
                $array_data[$key]['mother_name'] = $mname;
                $array_data[$key]['date_of_birth'] = $dob;
                $array_data[$key]['class'] = $class;
                $array_data[$key]['adhar_number'] = $adhar;
                $array_data[$key]['email_id'] = $email;
                $array_data[$key]['phone_number'] = $phone;
            }
        }
        if (file_put_contents($filename, json_encode($array_data, JSON_PRETTY_PRINT))) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
