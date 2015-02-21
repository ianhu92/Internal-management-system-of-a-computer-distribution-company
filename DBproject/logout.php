<?php
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['usertype']);
    unset($_SESSION['sid']);
    exit("<script> alert(\"Logout success!\");window.location.href='index.php';  </script>");
?>