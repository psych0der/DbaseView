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

$pages = new Paginator();  
$db->select('client',true);
$pages->setItemsTotal($db->getResult());  
$pages->setMidRange(9);  
$pages->paginate();  

$response = $db->select('client',false,'id,s_first,s_last,city,state,company',null,null,$pages->getLimit());
if(!$response)
    echo $db->error();
else
    $result = $db->getResult();

    






?>
<!--- FORM MARKUP -->


<!html>
<head>
	<title>dBaseViewer</title>
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
            <li><a href="clients.php"><i class="icon-stats-up"></i>Companies</a></li>
            
        </ul>
 	</section>

 </aside>
 

 <section id="content">

<header>
    <h1>Client-List</h1>
    <a href="clientadd.php"><div id="add-client"> <b class="icon-plus"></b><p id="add-text"><i>Add Client</i></p></div></a>


<div class="input-control text search" id="search">
        <input type="text" />
        <button class="btn-search"></button>
    </div>

</header>

<div id="table-wrapper">
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

for($i = 0 ; $i < count($result) ; $i++)
{
echo "<tr>";
echo "<td><a href=\"showclient.php?id=".$result[$i]['id']."\">".$result[$i]['s_first']." ".$result[$i]['s_last']."</a></td>";
echo "<td><a href=\"showclient.php?id=".$result[$i]['id']."\">".$result[$i]['company']."</a></td>";
echo "<td><a href=\"showclient.php?id=".$result[$i]['id']."\">".$result[$i]['city'].",".$result[$i]['city']."</a></td>";
echo "</tr>";


}



?>
    
</tbody>
</table>
</div>
<div id="pagination">
<?php
echo "Page ".$pages->getCurrentPage()." of ".$pages->getNumPage(); 
echo "</br></br>";

echo $pages->display_pages();



?>

</div>
       
</section>
	
<footer>

created by Mayank Bhola . copyright (C) Mayank Bhola 2013 . All rights reserved.

</footer>

</body>

</html>