<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: {$host}/php/html/login.html");
}
    $output="";
    $filename = '../admin/json/class'.$_SESSION['class'].'/studentRecord-'.$_SESSION['class'].'.json';
    $array_data = json_decode(file_get_contents($filename),true);
    foreach($array_data as $key => $value){
        if($_SESSION['username'] == $value['student_name'] && $_SESSION['id'] == $value['id']){
            $output.=   "<table>
                            <thead>
                                <th>Student-Id :- </th>
                                <td>{$_SESSION['id']}</td>
                            </thead>
                            <thead>
                                <th>Student Name :- </th>
                                <td><input type='text' id='name' value='{$value['student_name']}'></td>
                            </thead>
                            <thead>
                                <th>Student Father's Name :- </th>
                                <td><input type='text' id='fname' value='{$value['father_name']}'></td>
                            </thead>
                            <thead>
                                <th>Student Mother Name :- </th>
                                <td><input type='text' id='mname' value='{$value['mother_name']}'></td>
                            </thead>
                            <thead>
                                <th>Student date of birth :- </th>
                                <td><input type='date' id='date' value='{$value['date_of_birth']}'></td>
                            </thead>
                            <thead>
                                <th>Student Class :- </th>
                                <td><input type='text' id='class' value='{$value['class']}'></td>
                            </thead>
                            <thead>
                                <th>Student Adhar Number :- </th>
                                <td><input type='text' id='adhar' value='{$value['adhar_number']}'></td>
                            </thead>
                            <thead>
                                <th>Student Email Id :- </th>
                                <td><input type='email' id='email' value='{$value['email_id']}'></td>
                            </thead>
                            <thead>
                                <th>Student Phone Number :- </th>
                                <td><input type='phone' id='phone' value='{$value['phone_number']}'></td>
                            </thead>
                            <thead>
                                <th>Student Photo:- </th>
                                <td><img src='../../admin/JSON/class{$value['class']}/upload/{$value['image_name']}' alt='#'></td>
                            </thead>
                            <thead>
                                <th><button id='close'>Close</button></th>
                                <th><button id='submit'>Apply</button></th>
                            </thead>
                        </table>";
        }
    }
file_put_contents($filename, json_encode($array_data, JSON_PRETTY_PRINT));
echo $output;
?>