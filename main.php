<?php
//Enter your Database information
define('MYSQL_HOST', 'localhost');//اسم سرور که به صورت معمول localhost میباشد
define('MYSQL_USER', 'نام کاربری بانک اطلاعاتی');
define('MYSQL_PASSWORD', 'رمز عبور بانک اطلاعاتی');
define('MYSQL_DATABASE', 'اسم دیتا بیس');


//Enter your Website Url
define('SITE_URL', 'http://localhost/linksmaller/');//Inter Your Website Address
define('SHORT_URL', SITE_URL.'index.php?short_code=');//*** Don`t Edit This *****


//*** Don`t Edit This *****
require_once ("dbconfig.php");
require_once ("class/shortener.php");

