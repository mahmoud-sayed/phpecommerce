<?php

//if (isset($_GET['do'])) {      // hear we say if the $_GET request come with some of do value take me to the page
//    $do = $_GET['do'];      // hear we send the do value in te $_GET request t show the specific page
//} else {
//    $do = 'manage';     // hear we say if nothing come to you with any value or come with pad value make $do = 'manage';
//                        // and this will take you to the page i have import it before
//}
$do = isset($_GET['do']) ? $_GET[$do] : 'manage';  //  this is the same commented last if up^^^ there i have commented

// if the page is main page

if ($do == 'manage'){                               // hear we send the do with manage
    echo 'welcom you are in manage category page';  // hear we send the message
    echo '<a href="?do=add">Add new category</a>';  // hear we make the link will send us on click to the add page
}elseif ($do == 'add'){                             //this will wend us to add page
    echo 'welcome you are in add category page';    // the message form add page
}elseif ($do == 'insert'){                          //this will wend us to insert page
    echo 'welcome you are in insert category page';
}else{                                              // this the error message if the clint try to play around
    echo 'Error there\'s no page with this name';
}