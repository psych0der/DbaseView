<?php  
  
/**
 * Copyright information
 * @author Mayank Bhola <mayankbhola@gmail.com>
 * @copyright Copyright (c) 2013, Mayank Bhola
 * @version 0.9 
 */
  

include './resources/config.php';
include './resources/library/database.php';
include './resources/library/paginator.php';

$db = new Database($config['db']['db1']['host'],$config['db']['db1']['username'],$config['db']['db1']['password'],$config['db']['db1']['dbname']);

$response = $db->insert('company_details',array($_REQUEST['id'],$_REQUEST['service'],$_REQUEST['username'],$_REQUEST['password']),array('id','service','username','pass'));

if($response)
{
	echo " success";
}
else 
	echo " failure";

?>

