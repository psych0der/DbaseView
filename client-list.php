<?php  
  
/**
 * Copyright information
 * @author Mayank Bhola <mayankbhola@gmail.com>
 * @copyright Copyright (c) 2013, Mayank Bhola
 * @version 0.9 
 */
  

include './resources/config.php';
include './resources/library/database.php';

$db = new Database($config['db']['db1']['host'],$config['db']['db1']['username'],$config['db']['db1']['password'],$config['db']['db1']['dbname']);



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

</header>

<div id="table-wrapper">
<table class="customt">
 <thead>
    <tr>
       
        <th scope="col">Name</th>
        <th scope="col">Company</th>
        <th scope="col">city/state</th>
    </tr>
</thead>
<tbody>
    <tr>
        
        <td>Cell b1</td>
        <td>Cell c1</td>
        <td>Cell d1</td>
    </tr>
    <tr>
        
        <td>Cell b2</td>
        <td>Cell c2</td>
        <td>Cell d2</td>
    </tr>
    <tr>
        
        <td>Cell b3</td>
        <td>Cell c3</td>
        <td>Cell d3</td>
    </tr>
</tbody>
</table>
</div>

       
</section>
	
<footer>

created by Mayank Bhola . copyright (C) Mayank Bhola 2013 . All rights reserved.

</footer>

</body>

</html>