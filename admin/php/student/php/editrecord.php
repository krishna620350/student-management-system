<?php
include "../../config.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: {$host}/php/login.html");
}
    $sid = $_POST['sid'];
    for($i=1;$i<=12;$i++){
        $filename = '../../../json/class' . $i . '/studentrecord-' . $i . '.json';

        $contant_data = file_get_contents($filename);
        $array_data = json_decode($contant_data, true);
        
        $output = "";
        for($j=0;$j<count(array($array_data));$j++){
            if($sid == $array_data[$j]['id']){
                $output.="<table style='width:60%'>
                                <tr hidden>
                                    <td><input type='text' id='sid' value='{$array_data[$j]['id']}'></td>
                                </tr>
                                <tr>
                                    <td><label>Name :- </label></td>
                                    <td><input type='text' id='name' value='{$array_data[$j]['student_name']}'></td>
                                </tr>
                                <tr>
                                    <td><label>Father Name :- </label></td>
                                    <td><input type='text' id='fname' value='{$array_data[$j]['father_name']}'></td>
                                </tr>
                                <tr>
                                    <td><label>Mother Name :- </label></td>
                                    <td><input type='text'
                                    id='mname' value='{$array_data[$j]['mother_name']}'></td>
                                </tr>
                                <tr>
                                    <td><label>Date of birth :- </label></td>
                                    <td><input type='date' id='dob' value='{$array_data[$j]['date_of_birth']}'></td>
                                </tr>
                                <tr>
                                    <td><label>Class :- </label></td>
                                    <td><input type='text' id='class' value='{$array_data[$j]['class']}' ></td>
                                </tr>
                                <tr>
                                    <td><label>Adhar Number :- </label></td>
                                    <td><input type='text' id='adhar' value='{$array_data[$j]['adhar_number']}'></td>
                                </tr>
                                <tr>
                                    <td><label>Email Id :- </label></td>
                                    <td><input type='email' id='email' value='{$array_data[$j]['email_id']}'></td>
                                </tr>
                                <tr>
                                    <td><label>Phone No :- </label></td>
                                    <td><input type='phone' id='phone' value='{$array_data[$j]['phone_number']}'></td>
                                </tr>
                                <tr>
                                    <td><label>Upload Photo :- </label></td>
                                    <td><img src='../../../json/class{$i}/upload/{$array_data[$j]['image_name']}' width='100' height='100'></td>
                                </tr>
                                <tr>
                                    <td><button type='submit' id='updated'>Update_Record</button></td>
                                </tr>
                            </table>";

            }
        }
        if(file_put_contents($filename,json_encode($array_data,JSON_PRETTY_PRINT))){
            echo $output;
        }else{
            echo "error";
        }
    }
?>