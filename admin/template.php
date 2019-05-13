<?php
/*
 * this the template page i will uwe it in all pages
 * ==============================
 * ===template page
 * ==============================
 */

ob_start();
session_start();
    $pagetitle = '';
    if (isset($_SESSION['userName'])) {
        include 'init.php';
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
        if ($do == 'Manage') {

        }elseif ($do == 'add'){

        }elseif ($do == 'insert'){

        }elseif ($do == 'edit'){

        }elseif ($do == 'update')   {

        }elseif ($do == 'Delete'){

        }elseif ($do == 'activate'){

        }

        include $tpl . 'footer.php';
    } else {
        header('location: index.php');
        exit();
    }
ob_end_flush();