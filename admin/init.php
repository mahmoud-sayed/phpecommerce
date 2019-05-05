<?php

	include 'connect.php';      // to print the massage in the admin index

	// start Routs
	$tpl = 'includes/templets/';  // rout for templates
	$css = 'layout/css/';      // rout for css
	$js = 'layout/js/';   // rout for js
	$lang ='includes/languages/';   // language directory
	$func ='includes/functions/'; //functions directory
	// end Routs

	//  the important files to include
    include $func . 'function.php';
    include  $lang . 'english.php';
	include  $tpl . 'header.php';

	
	
	if(!isset($noNavBar))
	{
	 include  $tpl . 'navbar.php'; 
	}
