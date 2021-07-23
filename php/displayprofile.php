<?php
    session_start();
if (!isset($_SESSION['username'])) {
    header("location: {$host}/php/html/login.html");
}
    $filename = '../admin/json/class'.$_SESSION['class'].'/studentRecord-'.$_SESSION['class'].'.json';
    $array_data = json_decode(file_get_contents($filename),true);
    $output = "<h3>Student-Profile</h3>";
    foreach($array_data as $key => $value){
        if($_SESSION['id'] == $value['id'] && $_SESSION['username'] == $value['student_name']){
            $output.=   "<table>
                            <thead>
                                <th>Student-Id :- </th>
                                <td>{$_SESSION['id']}</td>
                            </thead>
                            <thead>
                                <th>Student Name :- </th>
                                <td>{$value['student_name']}</td>
                            </thead>
                            <thead>
                                <th>Student Father's Name :- </th>
                                <td>{$value['father_name']}</td>
                            </thead>
                            <thead>
                                <th>Student Mother Name :- </th>
                                <td>{$value['mother_name']}</td>
                            </thead>
                            <thead>
                                <th>Student date of birth :- </th>
                                <td>{$value['date_of_birth']}</td>
                            </thead>
                            <thead>
                                <th>Student Class :- </th>
                                <td>{$value['class']}</td>
                            </thead>
                            <thead>
                                <th>Student Adhar Number :- </th>
                                <td>{$value['adhar_number']}</td>
                            </thead>
                            <thead>
                                <th>Student Email Id :- </th>
                                <td>{$value['email_id']}</td>
                            </thead>
                            <thead>
                                <th>Student Phone Number :- </th>
                                <td>{$value['phone_number']}</td>
                            </thead>
                            <thead>
                                <th>Student Photo:- </th>
                                <td><img src='../../admin/JSON/class{$value['class']}/upload/{$value['image_name']}' alt='#'></td>
                            </thead>
                            <thead>
                                <th><button id='close'>Close</button></th>
                            </thead>
                        </table>";
        }
    }
file_put_contents($filename, json_encode($array_data, JSON_PRETTY_PRINT));
    echo $output;
?>