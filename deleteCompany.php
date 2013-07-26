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

$response = $db->delete('company',"id ='".$_REQUEST['id']."'");
$response &= $db->delete('lod',"`comp-id` ='".$_REQUEST['id']."'");
$response &= $db->delete('company_details',"`id` ='".$_REQUEST['id']."'");
$response &= $db->delete('cservices',"`id` ='".$_REQUEST['id']."'");
$response &= $db->delete('it_history',"`id` ='".$_REQUEST['id']."'");
$response &= $db->delete('services',"`id` ='".$_REQUEST['id']."'");
$response &= $db->delete('tin',"`id` ='".$_REQUEST['id']."'");

if($response)
{
	echo true;
}
else 
	echo false;

?>

