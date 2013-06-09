<?php  
  
/* 
     Created by Mayank Bhola
     copyright (c) 2013 . All rights reserved


     config file to store DB connection settings.
     !! to be included in every php file
*/  
  
$config = array(  
    "db" => array(  
        "db1" => array(  
            "dbname" => "database1",  
            "username" => "root",  
            "password" => "root",  
            "host" => "localhost:8888"  // change in final implementation for windows
        ),  
        "db2" => array(  
            "dbname" => "database2",  
            "username" => "dbUser",  
            "password" => "pa$$",  
            "host" => "localhost"  
        )  
    ),  
    "urls" => array(  
        "baseUrl" => "http://localhost:8888/"  
    ),  
    "paths" => array(  
        "resources" => "/path/to/resources",  
        "images" => array(  
            "content" => $_SERVER["DOCUMENT_ROOT"] . "/img/content",  
            "layout" => $_SERVER["DOCUMENT_ROOT"] . "/img/layout"  
        )  
    )  
);  
  
/* 
    I will usually place the following in a bootstrap file or some type of environment 
    setup file (code that is run at the start of every page request), but they work  
    just as well in your config file if it's in php (some alternatives to php are xml or ini files). 
*/  
  
/* 
    Creating constants for heavily used paths makes things a lot easier. 
    ex. require_once(LIBRARY_PATH . "Paginator.php") 
*/  
defined("LIBRARY_PATH")  
    or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));  
      
defined("TEMPLATES_PATH")  
    or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));  
  
/* 
    Error reporting. 
*/  
ini_set("error_reporting", "true");  
error_reporting(E_ALL|E_STRCT);  
  
?>  