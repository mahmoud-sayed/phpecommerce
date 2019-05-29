<?php
    //Error Reporting
    ini_set('display_errors','on');
    error_reporting(E_ALL);


	include 'admin/connect.php';      // to print the massage in the admin index
    $sessionUser = '';
    if (isset($_SESSION['User'])){
        $sessionUser = $_SESSION['User'];
    }
	// start Routs
	$tpl = 'includes/templets/';  // rout for templates
	$css = 'layout/css/';      // rout for css
	$js = 'layout/js/';   // rout for js
	$lang ='includes/languages/';   // language directory
	$func ='includes/functions/'; //functions directory
	// end Routs

	//  the important files to includes
    include $func . 'function.php';
    include  $lang . 'english.php';
	include  $tpl . 'header.php';

