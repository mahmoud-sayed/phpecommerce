<?php

function lang( $phrase ){
    static $lang = array(
        //start navebar translation
        'shop_name'=>'free shop',
        'shop_Categories'=>'Categories',
        'items'=>'Items',
        'members'=>'Members',
        'statistics'=>'Statistics',
        'comments' =>'Comments',
        'logs'=>'Logs',        
        'admin_name'=>'Mahmoud',
            'index'=>'Visit shop',
            'Edit'=>'Edit Profile',
            'Settings'=>'Settings',
            'Logout'=>'Logout',

        //end navebar traslation
        

    );
    return $lang[$phrase];
}