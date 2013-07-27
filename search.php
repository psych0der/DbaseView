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

$flag = false;
if(isset($_POST['query']) and !empty($_POST['query']))
{
    $flag = true;
    $query = $_POST['query'];
}



if($flag)
{
    
    $search_query = "( s_first LIKE '%".$query."%') OR ( s_middle LIKE '%".$query."%') OR ( s_last LIKE '%".$query."%') OR ( pan LIKE '%".$query."%') OR (din LIKE '%".$query."%') OR ( city LIKE '%".$query."%') OR ( state LIKE '%".$query."%')";
    $search_query1 = "(name LIKE '%".$query."%') OR (pan LIKE '%".$query."%') OR (tax LIKE '%".$query."%') OR (nature LIKE '%".$query."%')";

    $db->select('client',true,'*',$search_query);
    $count = $db->getResult();
    
    $db->select('company',true,'*',$search_query1);
    $count1 = $db->getResult();
    
    $response = $db->select('client',false,'id,s_first,s_last,city,state,company',$search_query,null,null);
    if(!$response)
        echo $db->error();
    else
        $result = $db->getResult();

    $response1 = $db->select('company',false,'id,name,cin,nature',$search_query1,null,null);
    if(!$response1)
        echo $db->error();
    else
        $result2 = $db->getResult();

}

?>

<!--- TABLE MARKUP -->


<!html>
<head>
	<title>dBase-Search</title>
    <link rel="stylesheet" href="css/datepicker.css" type="text/css" />
	<link href="css/modern.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <link href="css/formstyle.css" rel="stylesheet">

    <script type="text/javascript" src="js/jquery2.js"></script>
    <script type="text/javascript" src="js/datepicker.js"></script>
    <script type="text/javascript" src="js/clientvalidate.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
     
       
    });
    </script>

</head>
<body>
	
 	<section class="metrouicss">

        
        
 <aside class="left-sidebar">
 	<header>
	<div class="sidebar-head">Control Panel </div>
 	</header>

 	<section id="panel">
 		<ul>
            <li><a href="index.php"><i class="icon-home"></i>Home</a></li>
            <li><a href="clients.php"><i class="icon-user-3"></i>Clients</a></li>
            <li><a href="companies.php"><i class="icon-stats-up"></i>Companies</a></li>
            
        </ul>
 	</section>

 </aside>
 

 <section id="content">

<header>
    <h1>dBase Search</h1>
   

<form id="search" action="search.php" method="post">
<div class="input-control text search" id="search1">
        <input type="text" name="query"/>
        <button class="btn-search"></button>
    </div>
</form>

</header>
<?php
if($flag)
{

    if($count==0)
    {
        echo "</br><center><h3><span class=\"label info\">Info</span> No clients found matching $query</h3></center>";
    }
else
{
?>
<div id="table-wrapper">
<h3>Client Results</h3>
<table class="customt">

 <thead>
    <tr>
       
        <th scope="col">Name</th>
        <th scope="col">Company</th>
        <th scope="col">Location</th>
    </tr>
</thead>
<tbody>
    <!--<tr>
        
        <td>Cell b1</td>
        <td>Cell c1</td>
        <td>Cell d1</td>
    </tr> -->
<?php 

if(!empty($result))
{
if(!isset($result[0]))
{
    $company = $result['company'];
    if(is_numeric($result['company']))
    {
        $res2 = $db->select('company',false,'name',"id=".$result['company'],null,null);
        $company_name = $db->getResult();
        $company = $company_name['name'];

    }

echo "<tr>";
echo "<td><a href=\"showclient.php?id=".$result['id']."\">".$result['s_first']." ".$result['s_last']."</a></td>";
echo "<td><a href=\"showclient.php?id=".$result['id']."\">".$company."</a></td>";
echo "<td><a href=\"showclient.php?id=".$result['id']."\">".$result['city'].",".$result['state']."</a></td>";
echo "</tr>";

}
else
{
for($i = 0 ; $i < count($result) ; $i++)
{
     $company = $result['company'];
    if(is_numeric($result[$i]['company']))
    {
        $res2 = $db->select('company',false,'name',"id=".$result[$i]['company'],null,null);
        $company_name = $db->getResult();
        $company = $company_name['name'];

    }
echo "<tr>";
echo "<td><a href=\"showclient.php?id=".$result[$i]['id']."\">".$result[$i]['s_first']." ".$result[$i]['s_last']."</a></td>";
echo "<td><a href=\"showclient.php?id=".$result[$i]['id']."\">".$company."</a></td>";
echo "<td><a href=\"showclient.php?id=".$result[$i]['id']."\">".$result[$i]['city'].",".$result[$i]['state']."</a></td>";
echo "</tr>";


}
}





}
?>
    
</tbody>
</table>
</div>
<?php
}
}
?>

<?php
if($flag)
{

    if($count1==0)
    {
        echo "</br><center><h3><span class=\"label info\">Info</span> No Comapanies found matching $query</h3></center>";
    }
else
{
?>
<div id="table-wrapper">
<h3>Company Results</h3>
<table class="customt">

 <thead>
    <tr>
       
        <th scope="col">Name</th>
        <th scope="col">CIN</th>
        <th scope="col">Nature</th>
    </tr>
</thead>
<tbody>
    <!--<tr>
        
        <td>Cell b1</td>
        <td>Cell c1</td>
        <td>Cell d1</td>
    </tr> -->
<?php 

if(!empty($result1))
{
if(!isset($result1[0]))
{
echo "<tr>";
echo "<td><a href=\"showcompany.php?id=".$result1['id']."\">".$result1['name']."</a></td>";
echo "<td><a href=\"showcompany.php?id=".$result1['id']."\">".$result1['cin']."</a></td>";
echo "<td><a href=\"showcompany.php?id=".$result1['id']."\">".$result1['nature'].",".$result['state']."</a></td>";
echo "</tr>";

}
else
{
for($i = 0 ; $i < count($result1) ; $i++)
{
echo "<tr>";
echo "<td><a href=\"showcompany.php?id=".$result1[$i]['id']."\">".$result1[$i]['name']."</a></td>";
echo "<td><a href=\"showcompany.php?id=".$result1[$i]['id']."\">".$result1[$i]['cin']."</a></td>";
echo "<td><a href=\"showcompany.php?id=".$result1[$i]['id']."\">".$result1[$i]['nature'].",".$result[$i]['state']."</a></td>";
echo "</tr>";


}
}





}
?>
    
</tbody>
</table>
</div>

<?php
}
}
?>



       
</section>
	
<footer>

created by Mayank Bhola . copyright (C) Mayank Bhola 2013 . All rights reserved.

</footer>

</body>

</html>