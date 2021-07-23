<?php
    include 'student/php/config.php';
include "config.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: {$host}/php/login.html");
}
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $dob = $_POST['dob'];
    $degin = $_POST['degin'];
    $adhar = $_POST['adhar'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $id = '0987'.substr($degin,0,2).'00'.substr($name,0,4);
    $filename = '../json/admin/adminrecord.json';
    if(file_exists($filename)){
        if (isset($_FILES['image'])) {
            $array_error = array();

            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];

            $temp = explode('.', $file_name);
            $file_ext = end($temp);

            $extension = array('jpeg', 'png', 'jpg');

            if (in_array($file_ext, $extension) === false) {
                $error[] = "this extension is not allowed, please chose another one";
            }
            if ($file_size > 5242800) {
                $error[] = "file size must be less than 5 mb";
            }

            $new_name = time() . '-' . basename($file_name);
            $target = '../json/admin/upload/'.$new_name;
            $image_name = $new_name;

            if (empty($error)) {
                move_uploaded_file($file_temp, $target);
            } else {
                print_r($error);
                die();
            }
        }
        $contant_data = file_get_contents($filename);
        $array_data = json_decode($contant_data,true);

        $new_array = array(
            'username' => $id,
            'admin_name' => $name,
            'father_name' => $fname,
            'mother_name' => $mname,
            'date_of_birth' => $dob,
            'degination'=> $degin,
            'adhar_number' => $adhar,
            'email_id' => $email,
            'phone_number' => $phone,
            'image_name' => $image_name
        );

        $array_data[] = $new_array;
        if(file_put_contents($filename,json_encode($array_data,JSON_PRETTY_PRINT))){
            header("location: {$host}");
        }else{
            echo "0";
        }
    }else{
        echo "00";
    }
?>