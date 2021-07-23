<?php
include "../../config.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: {$host}/php/login.html");
}
$id = $_POST['uid'];
$name = $_POST['uname'];
$dob = $_POST['udob'];
$class = $_POST['uclassname'];
$math = $_POST['umath'];
$science = $_POST['uscience'];
$social = $_POST['usocial'];
$hindi = $_POST['uhindi'];
$english = $_POST['uenglish'];
$percentage = 0;
$grade = "";
$status = "abscent";
$result = 0;
$percentage = ($math + $science + $social + $hindi + $english) / 5;
if ($percentage > 90) {
    $grade = "A+";
    $status = "pass";
} else if ($percentage > 75 && $percentage <= 90) {
    $grade = "A";
    $status = "pass";
} else if ($percentage > 55 && $percentage <= 75) {
    $grade = "B+";
    $status = "pass";
} else if ($percentage > 35 && $percentage <= 55) {
    $grade = "B";
    $status = "pass";
} else if ($percentage >= 33 && $percentage <= 35) {
    $grade = "C";
    $status = "pass";
} else if ($percentage < 33 && $percentage > 0) {
    $grade = "F";
    $status = "fail";
} else {
    $grade = "NON";
}
for ($i = 1; $i <= 12; $i++) {
    $filename ='../../../json/class' . $i . '/studentResult-' . $i . '.json';
    if (file_exists($filename)) {
        $array_data = json_decode(file_get_contents($filename), true);
        if (!empty($array_data)) {
            foreach ($array_data as $key => $value) {
                if ($value['id'] == $id) {
                    $array_data[$key]['student_name'] = $name;
                    $array_data[$key]['date_of_birth'] = $dob;
                    $array_data[$key]['class'] = $class;
                    $array_data[$key]['marks']['mathmatics'] = $math;
                    $array_data[$key]['marks']['science'] = $science;
                    $array_data[$key]['marks']['social_science'] = $social;
                    $array_data[$key]['marks']['hindi'] = $hindi;
                    $array_data[$key]['marks']['english'] = $english;
                    $array_data[$key]['percentage'] = $percentage;
                    $array_data[$key]['status'] = $status;
                    $array_data[$key]['grade'] = $grade;

                    $result = 1;
                }
            }
        }
        file_put_contents($filename, json_encode($array_data, JSON_PRETTY_PRINT));
    }
}
if ($result == 1) {
    echo '<div style="text-align:center;background-color:rgba(81, 252, 138, 0.473);padding: 10px;;border-radius: 1rem;font-size:18px;font-weight:bold;">updated</div>';
} else {
    echo '<div style="text-align:center;background-color:rgba(252, 81, 81, 0.473);padding: 10px;;border-radius: 1rem;font-size:18px;font-weight:bold;">cant update</div>';
}
?>