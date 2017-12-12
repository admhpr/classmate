<?php
if($_SERVER['SERVER_NAME'] == "localhost"){
    define("DEV_BUILD", false);
    define("SEND_LINK", false);
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "final_project");
   
    define("ROOT_PATH", "/adv-web-final-project/");
    define("ROOT_URL", "http://localhost/adv-web-final-project/");
}else{
    define("DEV_BUILD", false);
   
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "7bdaf8d3ca81e0e0f68cdc96c035e3da0ff2e16324647e66");
    define("DB_NAME", "final_project");

    define("ROOT_PATH", "");
    define("ROOT_URL", "classmate.slimapps.tech/");
};