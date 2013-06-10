<?php  
  
/**
 * Copyright information
 * @author Mayank Bhola <mayankbhola@gmail.com>
 * @copyright Copyright (c) 2013, Mayank Bhola
 * @version 0.9 
 */
  

/**
* This variable stores global db connection settings
* @name $config
*/


$config = array(  
    "db" => array(  
        "db1" => array(  
            "dbname" => "dbase",  
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