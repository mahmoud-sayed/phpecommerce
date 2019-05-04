<?php 
    session_start();
    if (isset($_SESSION['userName'])) {
        include 'init.php';
        echo 'dhashebord';
        include $tpl . 'footer.php';
    }else{
        header('location: index.php');
        exit();
    }