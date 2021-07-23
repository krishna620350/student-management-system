<?php
    include "config.php";
    include "../../config.php";
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: {$host}/php/login.html");
    }
    $class = $_POST['class'];
    $filename = '../../../json/class' . $class . '/studentrecord-' . $class . '.json';
    if(file_exists($filename)){
        $name = $_POST['name'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $adhar = $_POST['adhar'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $id = "012300".$class."00".substr($name,0,4);
        if(isset($_FILES['image'])){
            $array_error = array();

            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];

            $temp = explode('.', $file_name);
            $file_ext = end($temp);

            $extension = array('jpeg','png','jpg');

            if(in_array($file_ext,$extension)===false){
                $error[] = "this extension is not allowed, please chose another one";
            }
            if($file_size>5242800){
                $error[] = "file size must be less than 5 mb";
            }

            $new_name = time().'-'.basename($file_name);
            $target = '../../../json/class' . $class .'/upload/'.$new_name;
            $image_name = $new_name;

            if(empty($error)){
                move_uploaded_file($file_temp,$target);
            }else{
                print_r($error);
                die();
            }
        }

        $current_data = file_get_contents($filename);

        $array_data = json_decode($current_data,true);

        $new_data = array(
            'id' => $id,
            'student_name' => $name,
            'father_name' => $fname,
            'mother_name' => $mname,
            'date_of_birth' => $dob,
            'class' => $class,
            'adhar_number' => $adhar,
            'email_id' => $email,
            'phone_number' => $phone,
            'image_name' => $image_name
        );

        $array_data[] = $new_data;

        $json_data = json_encode($array_data,JSON_PRETTY_PRINT);

        if(file_put_contents($filename,$json_data)){
            header("location: {$host}/php/student/html/AddRecord.html");
        }else{
            echo "<h1 style='background-color:red;text-align: center;margin-top:30%;padding:20px;width:100%;'>Record Not Added, Go Back And Check Filled Details</h1><br><a href='../html/AddRecord.html'>back</a>";
        }
    }else{
        echo "<h1 style='background-color:red;text-align: center;margin-top:30%;padding:20px;width:100%;'>Record Not found</h1><br><a href='../html/AddRecord.html'  style='text-decoration:none;background-color:blue;padding:10px;color:white;margin-left:50%;'>back</a>";
    }
?>