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

$flag = false;

if(isset($_GET['id']) and !empty($_GET['id']))
{
    $flag = true;
    $id = $_GET['id'];
    $response = $db->select('company',false,'name',"id=$id",null);
    if($response)
        $company = $db->getResult();
    else
    {
        $db->error();
        $flag = false;
    }

    if(empty($company))
        $flag = false;
}

?>
<!--- FORM MARKUP -->


<!html>
<head>
	<title><?php  echo $company['name'];   ?></title>
    <link rel="stylesheet" href="css/datepicker.css" type="text/css" />
	<link href="css/modern.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <link href="css/formstyle.css" rel="stylesheet">

    <script type="text/javascript" src="js/jquery2.js"></script>
    <script type="text/javascript" src="js/datepicker.js"></script>
    <script type="text/javascript" src="js/clientvalidate.js"></script>

    <script type="text/javascript">
    
    function deleteCredential(user,pass)
         {
            
            var r = confirm('Are you sure you want to delete the credential');
            if(r==true)
            {
            
             $.ajax({ 
                 url : "delete-company-credential.php?user="+user+"&pass="+pass,
                async : false,
                });
            $('#'+user+pass).remove();
            }
        
    
        };
     


    $(document).ready(function() {

    $('#create1').click(function(){
    var miniform = $('<div id="custom-input" class="form"><form id="form2" class="sadd"><ul id="custom-ul"><li><input type="text" id="service" name="service" placeholder="gmail.com" class="custom-input name " required/><input type="text" id= "usname" name="usname" placeholder="username" class="custom-input name " required/><input type="text" id= "pswd" name="pswd" placeholder="password" class="custom-input name " required/><button class="submit bg-color-blue fg-color-white" id="ajax-insert" >add</button></li></ul></form></div>');
    var element =  document.getElementById('custom-input');
    if (element == null)
    {
    miniform.insertAfter($('#add_button'));
    $('#ajax-insert').click(clickEvent);
    }
    });


      var clickEvent = function(event){
        event.preventDefault();
        var serv = $('#service').val();
        var uname = $('#usname').val();
        var pswd = $('#pswd').val();
        $.get( 
             "insert_company_credential.php",
             { id :<?php echo $id; ?> ,service: serv,username : uname , password : pswd },
             function(data) {
                //alert(data);
                window.location.reload(true);
             }

          );
    };

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
<?php

if(!$flag)
{
    echo <<<span
    <div id="v-center">
    <h1>
    <center>
    <span class="label important" style="font-size:0.6em;margin-top:-15px;">Error : </span>
    Client unavailable
    </center>
    </h1>
    </div>

span;
}

else 
{

?>


<div class="add">
	<ul>
    <li>
         <header class="head">
			<span>
            <?php 
             echo "<a href=\"showcompany.php?id=$id\">".$company['name']." "."</a></br></br><h3><i>Login Credentials</i></h3>";
             
            ?>
            </span>
		</header>
         
    </li>
     
   


    <?php
    }
    ?>


    
  	
    </br>
    </br>
    <?php
    $res1 = $db->select('company_details',false,'*',"`id`=$id",null);
    if($res1)
        $credential = $db->getResult();
    else
        $db->error();




    ?>
    <li>
        <table class="striped">
            <caption>Credentials</caption>
            <thead>
                <tr>
                     <th scope="col"></th>
                     <th scope="col">Service</th>
                     <th scope="col">username</th>
                     <th scope="col">password</th>
                </tr>
                </tr>
            </thead>
            <tbody>
            <?php 
            
        if(!empty($credential))
        {
            if(!isset($credential[0]))
            {
                    echo "<tr id=\"".$credential['username'].$credential['pass']."\">";
                    echo "<td><i class=\"icon-cancel\" style=\"color:red;\"  onclick =\"deleteCredential('".$credential['username']."','".$credential['pass']."');\"></i></td>";
                    echo "<td>".$credential['service']."</td>";
                    echo "<td>".$credential['username']."</td>";
                    echo "<td>".$credential['pass']."</td>";
                    echo "</tr>";
            }

            else
            {
            for($i = 0 ; $i < count($credential) ; $i++)
                {

                    echo "<tr id=\"".$credential[$i]['username'].$credential[$i]['pass']."\">";
                    echo "<td><i class=\"icon-cancel\" style=\"color:red;\"  onclick =\"deleteCredential('".$credential[$i]['username']."','".$credential[$i]['pass']."');\"></i></td>";
                    echo "<td>".$credential[$i]['service']."</td>";
                    echo "<td>".$credential[$i]['username']."</td>";
                    echo "<td>".$credential[$i]['pass']."</td>";
                    echo "</tr>";
            
                }
            }
        }  

            ?>




            </tbody>
            

        </table>
    </li>


    <li id="add_button">
        <center><button class="submit bg-color-green fg-color-white"  id="create1">Add Login</button>
       
        
    </li>


	</ul>
	








 </section>
       
</section>

	
<footer style="position:fixed;bottom:0;height:2%;">

created by Mayank Bhola . copyright (C) Mayank Bhola 2013 . All rights reserved.

</footer>

</body>

</html>