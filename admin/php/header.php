<?php
include "config.php";
session_start();
if(!isset($_SESSION['username'])){
    header("Location: {$host}/php/login.html");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Student Admin-Pannel</title>
</head>

<body>
    <div class="container">
        <div class="heading">
            <h1>Krishna Insitute Of Enginnering</h1>
            <h2>Admin-Pannel</h2>
            <h3>Home</h3>
        </div>
        <nav>
            <div class="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Student</a>
                        <div class="sub-list-1">
                            <ul>
                                <li>
                                    <input type="text" name="search" placeholder="Search Student Record">
                                    <button type="submit">search</button>
                                </li>
                                <li><a href="php/student/html/AddRecord.html" target="_blank">Add-Record</a></li>
                                <li><a href="php/student/html/displayrecord.html" target="_blamk">display-Record</a></li>
                                <li><a href="php/student/html/editrecord.html" target="_blank">Edit-Record</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="#">Result</a>
                        <div class="sub-list-1">
                            <ul>
                                <li>
                                    <input type="text" name="search" placeholder="Search Student Result">
                                    <button type="submit">search</button>
                                </li>
                                <li><a href="php/student/html/addresult.html" target="_blank">Add-Result</a></li>
                                <li><a href="php/student/html/displayresult.html" target="_blank">display-Result</a></li>
                                <li><a href="php/student/html/editresult.html" target="_blank">Edit-Result</a></li>
                                </ul>
                        </div>
                    </li>
                    <li><a href="#">Fee</a></li>
                </ul>
            </div>
            <div class="buttons">
                <ul>
                    <li><a href=""><?php echo $_SESSION['username']; ?></a>
                        <div class="sub-logout">
                            <ul>
                                <li><a href="php/logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><button><a href="php/addadmin.html">Add-Admin</a></button></li>
                </ul>

            </div>
        </nav>