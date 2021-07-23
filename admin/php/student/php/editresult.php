<?php
include "../../config.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: {$host}/php/login.html");
}
    $sid = $_POST['sid'];
    for($i = 1;$i<=12;$i++){
        $filename ='../../../json/class' . $i . '/studentResult-' . $i . '.json';
        if(file_exists($filename)){
            $output = "";
            $array_data = json_decode(file_get_contents($filename),true);
            if(!empty($array_data)){
                foreach($array_data as $key => $value){
                    if($value['id'] == $sid){
                        $output.="<table style='width:100%'>
                                <tr>
                                    <td>Student Id :- </td>
                                    <td><input type='text' id='sid' value='{$value['id']}'></td>
                                </tr>
                                <tr>
                                    <td><label>Name :- </label></td>
                                    <td><input type='text' id='name' value='{$value['student_name']}'></td>
                                </tr>
                                <tr>
                                    <td><label>Date of birth :- </label></td>
                                    <td><input type='date' id='dob' value='{$value['date_of_birth']}'></td>
                                </tr>
                                <tr>
                                    <td><label>Class :- </label></td>
                                    <td><input type='text' id='class' value='{$value['class']}' ></td>
                                </tr>
                                <tr>
                                    <td><label>Marks :- </label></td>
                                    <td>
                                        <table>
                                            <tbody>
                                                <tr>
                                                <td>Mathmatics :- </td>
                                                <td><input type='text' id ='math' value='{$value['marks']['mathmatics']}'></td></tr>
                                                <tr>
                                                <td>Science:- </td>
                                                <td><input type='text' id ='science' value='{$value['marks']['science']}'></td></tr>
                                                <tr>
                                                <td>Social-Science :- </td>
                                                <td><input type='text' id ='social' value='{$value['marks']['social_science']}'></td></tr>
                                                <tr>
                                                <td>Hindi :- </td>
                                                <td><input type='text' id ='hindi' value='{$value['marks']['hindi']}'></td></tr>
                                                <tr>
                                                <td>English :- </td>
                                                <td><input type='text' id ='english' value='{$value['marks']['english']}'></td></tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td><button type='submit' id='updated'>Update_Record</button></td>
                                </tr>
                            </table>";
                    }
                }
            }
            if (file_put_contents($filename, json_encode($array_data, JSON_PRETTY_PRINT))) {
                echo $output;
            } else {
                echo "Error";
            }
        }
    }
?>