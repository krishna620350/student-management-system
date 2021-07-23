<?php
include "../php/config.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: {$host}/php/login.html");
}
?>