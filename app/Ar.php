<?php
function lang($phrase)
{
     static $lang = array(
         // NAV BAR VOCAB
         'HOME' => 'الرئيسية',
         'CATEGORIES' => 'الأقسام',
         'ITEMS' => 'عناصر',
         'MEMBERS' => 'الأعضاء',
         'STATISTICS' => 'احصائيات',
         'LOGS' => 'سجلات',
         "Edit Profile" => 'تعديل الصفحة الشخصية ',
         "Settings"  => 'الاعدادات',
         "Logout" => 'تسجيل الخروج ',
         "options" => 'خيارات',
         "Visit Shop" =>'زيارة المتجر'
     );
     return $lang[$phrase];
}