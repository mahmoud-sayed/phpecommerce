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
        if ($do == 'Manage') {  // this is the mane page of items

        }elseif ($do == 'add'){ // the page that we will define or input the items from

        }elseif ($do == 'insert'){ //to add all of the values in database

        }elseif ($do == 'edit'){ // this is the page we will input the value inside

        }elseif ($do == 'update'){ //this is the page we are sending the value tho the database

        }elseif ($do == 'Delete'){  // thi to delete the data form database

        }elseif ($do == 'active'){

        }

        include $tpl . 'footer.php';
    } else {
        header('location: index.php');
        exit();
    }
ob_end_flush();