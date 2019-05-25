<?php
    session_start();    // to start the session have come from
    $pagetitle = 'loginout';
    session_unset();    // to unset all of the data
    session_destroy();  // to destroy all of the data
    header('location: index.php');
    exit();