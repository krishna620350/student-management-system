<?php
include "../../config.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: {$host}/php/login.html");
}
    $class = $_POST['className'];
    $count = 1;
    $class_array = [1,2,3,4,5,6,7,8,9,1,10,11,12];
    for($i=0;$i<count($class_array);$i++){
        if($class == $class_array[$i]){
            $filename = '../../../json/class' . $class . '/studentrecord-' . $class . '.json';
            break;
        }
    }
    if($class>12){
        echo "";
    }
    $output="";
    if (file_exists($filename)){
        $output.= "
                <thead>
                    <th>S.no</th>
                    <th>Student Id</th>
                    <th>Student name</th>
                    <th>Father name</th>
                    <th>Mother name</th>
                    <th>Date of birth</th>
                    <th>Class</th>
                    <th>Adhar number</th>
                    <th>Email id</th>
                    <th>Phone number</th>
                    <th>Upload Photo</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>";
        $current_data = file_get_contents($filename);

        $array_data = json_decode($current_data, true);
        foreach($array_data as $key => $value){
            $output.="
                <tr>
                    <td>{$count}</td>
                    <td>{$value['id']}</td>
                    <td>{$value['student_name']}</td>
                    <td>{$value['father_name']}</td>
                    <td>{$value['mother_name']}</td>
                    <td>{$value['date_of_birth']}</td>
                    <td>{$value['class']}</td>
                    <td>{$value['adhar_number']}</td>
                    <td>{$value['email_id']}</td>
                    <td>{$value['phone_number']}</td>
                    <td><img src='../../../json/class{$class}/upload/{$value['image_name']}' alt='#'></td>
                    <td><a href='../html/editrecord.html?edit={$value['id']}'>Edit</a></td>
                    <td><a href='../php/deleterecord.php?delete={$value['id']}&&class={$value['class']}'>Delete</a></td>
                </tr>
            ";
            $count++;
        }
        echo $output;
    }
?>