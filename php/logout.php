<?php
    session_start();
if (!isset($_SESSION['username'])) {
    header("location: {$host}/php/html/login.html");
}
    switch($_POST['id']){
        case 'studentreport': echo $_SESSION['username'];
        break;
        case 'logout' : session_unset();
                        session_destroy();
                        echo "http://localhost/StudentManagement/php/login.html";
        break;
        default: echo "login please";
    }
?>