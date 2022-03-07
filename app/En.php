<?php
function lang($phrase)
{
    static $lang = array(
        // NAV BAR VOCAB
        'HOME'           => 'Home' ,
        'CATEGORIES'     => 'Categories',
        'ITEMS'          => 'Items',
        'MEMBERS'        => 'Members',
        'STATISTICS'     => 'Statistics',
        'LOGS'           => 'Logs',
         "Edit Profile" => 'Edit Profile ',
         "Settings"  => 'Settings',
         "Search Customers" => 'Search Customers',
         "Logout" => 'Logout',
         "options" => 'Options',
        "Visit Shop" =>'Visit Shop'
    );
    return $lang[$phrase];
}
