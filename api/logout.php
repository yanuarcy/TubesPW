<?php 
    include 'config/LoginConfig.php';
    session_start();
    if(isset($_SESSION['RoleUser'])){
        $rolUser = $_SESSION['RoleUser'];
        unset($_SESSION['logged_in']);
        // session_destroy();
        // header("Location: /");
        echo "<script>setTimeout(function(){ window.location.href = '/'; }, 1000);</script>";
    }
    if(isset($_SESSION['RoleAdmin'])){
        $rolAdmin = $_SESSION['RoleAdmin'];
        session_destroy();
        // unset($_SESSION['nama']);
        // unset($_SESSION['memberid']);
        // unset($_SESSION['username']);
        // unset($_SESSION['RoleAdmin']);
        // header("Location: /");
        echo "<script>setTimeout(function(){ window.location.href = '/'; }, 1000);</script>";
    }
    exit;

?>