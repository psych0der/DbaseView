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

$response = $db->insert('it_history',array($_REQUEST['id'],$_REQUEST['date'],$_REQUEST['ack'],$_REQUEST['year']),array('id','date','ackno','year'));

if($response)
{
	echo " success";
}
else 
	{
		$db->error();
		echo " failure";
		
	}

?>

