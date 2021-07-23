<?php
    // session_start();
    // if(!isset($_SESSION['username'])){
    //     header("location: {$host}/php/html/login.html");
    // }
    $output="<h1>Krishna Insitute Of Enginnering</h1>
            <h2>Kahalgaon, Bhagalpur 813203, Bihar</h2>
            ";
    switch($_POST['id']){
        case 'login': $output.="<h3>Login</h3>";
        break;
        case 'studentreport': $output.="<h3>Student-pannel</h3>";
        break;
        default: $output.="<h3>page fault</h3>";
    }
    echo $output;
?>