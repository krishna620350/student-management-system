<?php
    include "../../config.php";
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: {$host}/php/login.html");
    }
    $host = "http://localhost/StudentManagement/admin";
    
    $output ='<h1>Krishna Insitute Of Enginnering</h1>
            <h2>Admin-Pannel</h2>';
    switch($_POST['id']){
        case 'addrecord': $output.='<h3 style="margin-top:5px;">Add-Student-Record</h3>';
        break;
        case 'displayrecord': $output.= '<h3 style="margin-top:10px;">Display-Student-Record</h3>';
        break;
        case 'displayresult': $output.= '<h3 style="margin-top:10px;">Display-Student-Record</h3>';
        break;
        case 'editrecord': $output.= '<h3 style="margin-top:5px;">Update-Student-Record</h3>';
        break;
        case 'admin':$output .= '<h3 style="margin-top:5px;">Add-Admin</h3>';
        break;
        case 'addresult':$output .= '<h3 style="margin-top:5px;">Add-Student-Result</h3>';
        break;
        case 'editresult':$output .= '<h3 style="margin-top:5px;">Edit-Student-Result</h3>';
        break;
        default: $output.= '<h3 style="margin-top:5px">No such file exits</h3>';
    }
    echo $output;
?>