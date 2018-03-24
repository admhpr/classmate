<?php
require('env.php');
define("DEV_BUILD", true);
// Send confirmation link (useless in DEV mode unless xampp is set to send fake emails)
define("SEND_LINK", false);

// Define DB Params
define("DB_HOST", 'mariadb'); // or whatever your db host ip is
define("DB_USER", getenv('DB_USER') );
define("DB_PASS", getenv('DB_PASS') );
define("DB_NAME", getenv('DB_NAME') );

// Site recaptcha key
$siteKey = '6LeimE4UAAAAAEdA6JxZhmzF3N2T23FXxaHTxuo3';


// Define URL
define("ROOT_PATH", "/");
define("ROOT_URL", "http://localhost:8080/");
