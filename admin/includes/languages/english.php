<?php

function lang( $phrase ){
    static $lang = array(
        //start navebar translation
        'shop_name'=>'free shop',
        'shop_Categories'=>'Categories',
        'items'=>'Items',
        'members'=>'Members',
        'statistics'=>'Statistics',
        'logs'=>'Logs',        
        'admin_name'=>'Mahmoud',
            'Edit'=>'Edit Profile',
            'Settings'=>'Settings',
            'Logout'=>'Logout',

        //end navebar traslation
        

    );
    return $lang[$phrase];
}