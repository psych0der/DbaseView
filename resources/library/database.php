<?php

/**
* Database
*
*@package resources
*@author psych0der
*@copyright Copyright (c) 2013, psych0der
*/

class Database 
{

private $db_host = '';
private $db_user = '';
private $db_pass = '';
private $db_name = '';
private $conn = NULL;
private $result = array();

function __construct($host, $user, $pass , $name)
{

	$this->db_host = $host;
	$this->db_user = $user;
	$this->db_pass = $pass;
	$this->db_name = $name;
	$this->conn = NULL;
	$this->connect();


}

function __destruct()
{
	if(!$this->conn)
		$this->disconnect();

}

public function connect()
{

	if(!$this->conn)
	{

		$this->conn = new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
		if (mysqli_connect_errno())
		{
       		 
       		return false;
       	}

       	else 
       		return $this->conn;
	}

	else
		return $this->conn;
}

public function disconnect()
{

	if($this->conn)
		{
			$this->conn->close();
			$this->conn = NULL;

		}
}



public function changeDatabase($database)
{


	$this->conn->select_db($database);

}

public function tableExists($table)
{

	if($tableInDb = $this->conn->query('SHOW TABLES FROM'.$this->db_name.'LIKE "'.$table.'"'))
	{
		if($tableInDb->num_rows == 1)
			return true;

		else
			return false;
	
	}

	else
		return -1; // unable to connect to database
}

public function select($table,$count = false,$rows = "*",$where=null , $order = null ,$limit = null )
{

/*
flushing result

*/
	$this->result = array();

	if (is_array($rows))
		$rows = implode(',',$rows);

	if($count!=false)
		$q = 'SELECT COUNT(*) FROM '.$table;
	else
		$q = 'SELECT '.$rows.' FROM '.$table;
	
	if($where != NULL)
		$q.=' WHERE '.$where;

	if($order != NULL and $count==false)
		$q.= ' ORDER BY '.$order;

	if($limit != NULL and $count==false)
		$q.= $limit;

	

	if($this->tableExists($table))
	{
		//echo "</br>".$q;
		$response = $this->conn->query($q);
		
		if(!$response)
			return false;

		if($count==true)
		{
			$row = $response->fetch_array(MYSQLI_NUM);
			$this->result = $row[0];
			//echo $row[0];
			return true;

		}


		for($i = 0 ; $i< $response->num_rows; $i++)
		{
			$row = $response->fetch_array(MYSQLI_ASSOC);
			$key = array_keys($row);
			
		
			for($x = 0 ; $x < count($key);$x++ )
			{
				if(!is_int($key[$x]))
				{
					if($response->num_rows > 1)
						$this->result[$i][$key[$x]] = $row[$key[$x]];
					else if($response->num_rows == 1)
					{
						
						$this->result[$key[$x]] = $row[$key[$x]];
						//echo $this->result[$key[$x]];
					}
					else
						$this->result = NULL;

				}
			}

		}
	

		return true;

	}

	else
		return false;

}


public function insert($table ,$values ,$rows = null)
{
	$insert = 'INSERT INTO '.$table;
	
	if($rows !=null)
	{
		$rows = implode(',', $rows);
		$insert.= ' ('.$rows.')';

	}

	for ($i =0; $i < count($values);$i++)
	{

		if(is_string($values[$i]))
		{
			if($values[$i]=='')
				$values[$i] = "''";
			else
				$values[$i] = '"'.$values[$i].'"';
		

		}


	}

	$values = implode(',', $values);
	$insert .= ' VALUES ('.$values.' )';
	
	$result = $this->conn->query($insert);

	if($result)
		return true;
	else
		return false;

}

public function delete($table, $where= null)
{

	
	if($where == null)
		$delete = 'DROP TABLE '.$table;
	
	else
		$delete = 'DELETE FROM '.$table.' WHERE '.$where;

	//echo $delete;
	$result = $this->conn->query($delete);

	if( $result)
		return true;

	else
		return false;

}

/**
* @method boolean update(string $table , array::asoc $cols , array::$where)
*/

public function update($table,$cols, $where)
{
	
	if($this->tableExists($table))
	{
		// where clause parsing
		// even values including 0 contains where row
		// odd values contain the clauses for the row

		for($i = 0 ; $i <count($where);$i++ )
		{

			if($i%2!=0)
			{
				if(is_string($where[$i]))
				{

					if($i < count($where)-1)
						$where[$i] = '"'.$where[$i].'" AND ';
					else
						$where[$i] = '"'.$where[$i].'"';

				}
			}

		}


		$where = implode('=',$where);

		$update = 'UPDATE '.$table.' SET ';
		$keys = array_keys($cols);
		for($i = 0; $i < count($cols);$i++)
		{
			if(is_string($cols[$keys[$i]]))
				$update .= $keys[$i].'="'.$cols[$keys[$i]].'"';

			else
				$update .= $keys[$i].'='.$cols[$keys[$i]];

			if($i != count($cols)-1)
				$update .= ',';
		}

	

		$update .=' WHERE '.$where;
		//echo $update;
		$result = $this->conn->query($update);

		if($result)
			return true;

		else
			return false;

	}
	else
		return false;


}

public function getResult()
{
	
	return $this->result;
}

public function error()
{
	return $this->conn->error;
}

}

?>