<?php
// configuration array cast as object to allow for nice['syntax'] not wierd->syntax
    return (object)array(
        'dev_build' => true,
        'host' => $_SERVER['SERVER_NAME'],
        'username' => 'root',
        'password' => '',
        'db_name' => "final_project",
        'site_domain' => $_SERVER['SERVER_NAME'],
        'site_admin' => "dev",
        'site_maintainer' => "postmaster@localhost"
    );
?>