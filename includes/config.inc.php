<?php
    // this is the main configuration file for the website
    session_start();
    define("STANDARD_USER_ROLE", 1);
    define("ADMIN_ROLE", 2);
    // detect which environment the code is running in
    if($_SERVER['SERVER_NAME'] == "localhost"){
        // DEV ENVIRONMENT SETTINGS
        define("DEBUG_MODE", true);
        define("DB_HOST", "localhost");
        define("DB_USER", "root");
        define("DB_PASSWORD", "");
        define("DB_NAME", "final_project");
        define("SITE_ADMIN_EMAIL", "developer@company");
        define("SITE_DOMAIN", $_SERVER['SERVER_NAME']);
    }else{
        // PRODUCTION SETTINGS
        define("DEBUG_MODE", false); 
        // you may want to set DEBUG_MODE to true when you 
        // are first setting up your live site, but once you get
        // everything working you'd want it off.
        define("DB_HOST", "production db server goes here");
        define("DB_USER", "production user name goes here");
        define("DB_PASSWORD", "production password goes here");
        define("DB_NAME", "production db name goes here");
        define("SITE_ADMIN_EMAIL", "XXXXXXXX");
        define("SITE_DOMAIN", $_SERVER['SERVER_NAME']);
    }

    // if we are in debug mode then display all errors and set error reporting to all 
    if(DEBUG_MODE){
        // turn on error messages
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
 
?>