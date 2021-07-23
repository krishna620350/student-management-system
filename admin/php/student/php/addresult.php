<?php
    include '../../config.php';
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: {$host}/php/login.html");
    }
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $class = $_POST['class'];
    $math = $_POST['math'];
    $science = $_POST['science'];
    $social = $_POST['social'];
    $hindi = $_POST['hindi'];
    $english = $_POST['english'];
    $percentage =0;
    $grade= "";
    $status = "abscent";
    $percentage = ($math+$science+$social+$hindi+$english)/5;
    if($percentage>90){
        $grade= "A+";
        $status = "pass";
    }else if($percentage>75 && $percentage<=90){
        $grade= "A";
        $status = "pass";
    }else if($percentage>55 && $percentage<=75){
        $grade= "B+";
        $status = "pass";
    }else if($percentage>35 && $percentage<=55){
        $grade= "B";
        $status = "pass";
    }else if($percentage>=33 && $percentage<=35){
        $grade= "C";
        $status = "pass";
    }else if($percentage<33 && $percentage>0){
        $grade= "F";
        $status = "fail";
    }else{
        $grade= "NON";
    }
    for($i =1;$i<=12;$i++){
        if($i == $class){
            $filename = '../../../json/class'.$class.'/studentResult-'.$class.'.json';
            $filename_record = '../../../json/class' . $class . '/studentRecord-' . $class . '.json';
            $array_record = json_decode(file_get_contents($filename_record),true);
            foreach($array_record as $key => $value){
                if($value['id'] == $id && $value['student_name'] == $name && $value['date_of_birth'] == $dob && $value['class'] == $class){
                    if (file_exists($filename)) {
                        $array_data = json_decode(file_get_contents($filename), true);
                        $new_data = array(
                            "id" => $id,
                            "student_name" => $name,
                            "date_of_birth" => $dob,
                            "class" => $class,
                            "marks" => array(
                                "mathmatics" => $math,
                                "science" => $science,
                                "social_science" => $social,
                                "hindi" => $hindi,
                                "english" => $english
                            ),
                            "percentage" => $percentage,
                            "grade" => $grade,
                            "status" => $status
                        );
                        $array_data[] = $new_data;
                        if (file_put_contents($filename, json_encode($array_data, JSON_PRETTY_PRINT))) {
                            header("Location: {$host}/php/student/html/addresult.html");
                        } else {
                            echo "unsuccess";
                        }
                    } else {
                        echo "file does not exists";
                    }
                }else{
                    echo "record does not exists";
                    continue;
                }
            }
            break;
        }
    }
?>