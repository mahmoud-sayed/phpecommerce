<?php

function lang( $phrase ){
    static $lang = array(
        //start navebar translation
        'Main_Page'=>'Home Page',
        'shop_Categories'=>'Categories',
        'items'=>'Items',
        'members'=>'Members',
        'statistics'=>'Statistics',
        'comments' =>'Comments',
        'logs'=>'Logs',        
        'admin_name'=>'Mahmoud',
            'Edit'=>'Edit Profile',
            'Settings'=>'Settings',
            'Logout'=>'Logout',

        //end navebar traslation
        

    );
    return $lang[$phrase];
}