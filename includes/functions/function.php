<?php

// this is the website functions

/*
 * get records function V1.0
 * function to get categories form database
 */

function getCat(){
    global $con;
    $getCat = $con->prepare("SELECT * FROM categories ORDER BY id ASC");
    $getCat->execute();
    $cats = $getCat->fetchAll();
    return $cats;
}

/*
 * get items function V1.0
 * function to get categories form database
 */

function getItem($catId){
    global $con;
    $getItem = $con->prepare("SELECT * FROM items WHERE catId = ?  ORDER BY itemId DESC");
    $getItem->execute([$catId]);
    $items = $getItem->fetchAll();
    return $items;
}














/* this function to echo the page title if it exist */

function gitTitle(){
    global $pagetitle;
    if(isset($pagetitle)){
        echo $pagetitle;
    }else{
        echo 'Default';
    }
}
    /*
     * redirect function V2.0
     * this function accept parameters
     * $theMessage = to echo the [error , success , warning]
     * $seconds = the seconds before redirecting
     */
function redirectToHome($theMessage, $url= null, $seconds = 3){
    if ($url === null){
        $url = 'dashboard.php';
    }else{
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){
            $url = $_SERVER['HTTP_REFERER'];
        }else{
            $url = 'index.php';
        }
    }
    echo $theMessage;
    echo '<div class="alert alert-info container">' . 'you will be directed to ' . $url . ' after ' . $seconds . ' seconds'.'</div>';
    header("refresh:$seconds;url=$url");
    exit();
}

/*
 * check item function v1.0
 * function to check items in database [function accept parameters]
 * $select = the item to select [Example:   user, item, category]
 * $from = the table to select from [Example:   user, item, category]
 * $value = the value of select [Example: osama , Box, or any name]
 */

    function checkItems($select, $from, $value){    //hear we create function accept parameter
    global $con;                                // hear we create public var
    $statment = $con->prepare("SELECT $select FROM $from WHERE $select = ?");   // hear we selecting the items we will work on
    $statment->execute(array($value));  // hear we get the value
    $count = $statment->rowCount(); // hear we check if the name exist or not
    return $count;  // hear we return the hole function
}


/*
 * count number of functions
 * function to count number of items
 * $items = the items to count or to git the    numbes form the table
 * $table = the table to chose from
 */
function countItems($items, $table){
    global $con;
    $stmt2 = $con->prepare("SELECT COUNT($items) FROM $table");
    $stmt2->execute();
    return  $stmt2->fetchColumn();
}


/*
 * get latest recordes function V1.0
 * function to get latest items form database [users , items , comments]
 * $select = items to select
 * $table = tables name to select form
 * $limit = the items limit that we will be selected
 */

function getLatest($select, $table, $order, $limit = 5){
    global $con;
    $getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
    $getStmt->execute();
    $rows = $getStmt->fetchAll();
    return $rows;
}