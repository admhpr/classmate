<?php
if($_SERVER['SERVER_NAME'] == "localhost"){
    define("DEV_BUILD", true);
    define("SEND_LINK", true);
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "final_project");
   
    define("ROOT_PATH", "/adv-web-final-project/");
    define("ROOT_URL", "http://localhost/adv-web-final-project/");
}else{
    define("DEV_BUILD", false);
   
    define("DB_HOST", "localhost");
    define("DB_USER", "noctehe1_root");
    define("DB_PASS", "1qaz2wsx!QAZ@WSX");
    define("DB_NAME", "noctehe1_final_project");

    define("ROOT_PATH", "/webdevfinpro/");
    define("ROOT_URL", "https://nocteherba.com/webdevfinpro/");
};