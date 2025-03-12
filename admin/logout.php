<?php
    session_start();
    unset($_SESSION['casf_user']);
    header("Location: login.php");
?>