<?php
include "../../config.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: {$host}/php/login.html");
}
    $class = $_POST['className'];
    $filename = '../../../json/class'.$class.'/studentResult-'.$class.'.json';
    $output = "";
    $count = 1;
    if(file_exists($filename)){
        $array_data = json_decode(file_get_contents($filename),true);
        $output = "<thead>
                    <th>S.no</th>
                    <th>Student Id</th>
                    <th>Student name</th>
                    <th>Date of birth</th>
                    <th>Class</th>
                    <th>Marks
                        <table>
                            <thead>
                                <th>Maths</th>
                                <th>Science</th>
                                <th>Social-Science</th>
                                <th>Hindi</th>
                                <th>English</th>
                            </thead>
                        </table>
                    </th>
                    <th>Percentage</th>
                    <th>Grade</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>";
        foreach($array_data as $key => $value){
        $output .= "
                <tr>
                    <td>{$count}</td>
                    <td>{$value['id']}</td>
                    <td>{$value['student_name']}</td>
                    <td>{$value['date_of_birth']}</td>
                    <td>{$value['class']}</td>
                    <td><table>
                        <tr>
                            <td>{$value['marks']['mathmatics']}</td>
                            <td>{$value['marks']['science']}</td>
                            <td>{$value['marks']['social_science']}</td>
                            <td>{$value['marks']['hindi']}</td>
                            <td>{$value['marks']['english']}</td>
                        </tr>
                    </table></td>
                    <td>{$value['percentage']}</td>
                    <td>{$value['grade']}</td>
                    <td>{$value['status']}</td>
                    <td><a href='../html/editresult.html?edit={$value['id']}'>Edit</a></td>
                    <td><a href='../php/deleteresult.php?delete={$value['id']}&&class={$value['class']}' id='edit'>Delete</a></td>
                </tr>
            ";
            $count++;
        }
        echo $output;
    }
?>