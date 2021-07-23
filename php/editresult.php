<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: {$host}/php/html/login.html");
}
$output = "<h3>Apply For Modification</h3>";
$filename = '../admin/json/class'.$_SESSION['class'].'/studentResult-'.$_SESSION['class'].'.json';
$array_data = json_decode(file_get_contents($filename),true);
foreach ($array_data as $key => $value){
    if($value['id'] == $_SESSION['id'] && $value['student_name'] == $_SESSION['username']){
        $output.="<table>
                            <thead>
                                <th>Student-Id :- </th>
                                <td>{$_SESSION['id']}</td>
                            </thead>
                            <thead>
                                <th>Student Name :- </th>
                                <td><input type='text' id='name' value='{$value['student_name']}'></td>
                            </thead>
                            <thead>
                                <th>Student date of birth :- </th>
                                <td><input type='date' id='dob' value='{$value['date_of_birth']}'></td>
                            </thead>
                            <thead>
                                <th>Student Class :- </th>
                                <td>{$value['class']}</td>
                            </thead>
                            <thead>
                                <th>Correction Details :- </th>
                                <td><textarea id='textarea'></textarea></td>
                            </thead>
                            <thead>
                                <th><button id='close'>Close</button></th>
                                <th><button id='corrapply'>submit</button></th>
                            </thead>
                        </table>";
    }
}
file_put_contents($filename, json_encode($array_data, JSON_PRETTY_PRINT));
echo $output;
?>