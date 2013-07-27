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
    <link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">

    <script type="text/javascript" src="js/jquery2.js"></script>
    <script type="text/javascript" src="js/datepicker.js"></script>
    <script type="text/javascript" src="js/clientvalidate.js"></script>
     <script type="text/javascript" src="js/jqueryui.js"></script>

    <script type="text/javascript">
    
    function deleteTin(tin,state)
         {
            
            var r = confirm('Are you sure you want to delete the tin details');
            if(r==true)
            {
            
             $.ajax({ 
                 url : "delete-company-tin.php?tin="+tin+"&state="+state,
                async : false,
                });
            $('#'+tin+state).remove();
            }
        
    
        };
     


    $(document).ready(function() {

    $('#create1').click(function(){
    var miniform = $('<div id="custom-input" class="form"><form id="form2" class="sadd"><ul id="custom-ul"><li><div class=\"ui-widget\"><input type="text" id="tin" name="tin" placeholder="tin value"  class="custom-input name " required/><input type="text" id= "state" name="state" placeholder="state" class="custom-input name " required/><button class="submit bg-color-blue fg-color-white" id="ajax-insert" >add</button></div></li></ul></form></div>');
    
    var element =  document.getElementById('custom-input');
    if (element == null)
    {
    miniform.insertAfter($('#add_button'));
    $('#ajax-insert').click(clickEvent);
    }

    $('#state').autocomplete({
  source: ['Andhra Pradesh','Arunachal Pradesh','Assam','Bihar','Chhattisgarh','Goa','Gujarat','Haryana','Himachal Pradesh','Jammu & Kashmir','Jharkhand','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya','Mizoram','Nagaland','Odisha','Punjab','Rajasthan','Sikkim','Tamil Nadu','Tripura','Uttarakhand','Uttar Pradesh','West Bengal','Andaman & Nicobar','Chandigarh','Dadra and Nagar Haveli','Daman & Diu','Delhi','Lakshadweep','Puducherry'],
});
    

    });


      var clickEvent = function(event){
        event.preventDefault();
        
        var tin = $('#tin').val();
        var state = $('#state').val();
        
        $.get( 
             "insert_company_tin.php",
             { id :<?php echo $id; ?> ,tin:tin,state : state},
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
    Company unavailable
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
             echo "<a href=\"showcompany.php?id=$id\">".$company['name']." "."</a></br></br><h3><i>TIN details</i></h3>";
             
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
    $res1 = $db->select('tin',false,'*',"`id`=$id",null);
    if($res1)
        $tin = $db->getResult();
    else
        $db->error();




    ?>
    <li>
        <table class="striped">
            <caption>Credentials</caption>
            <thead>
                <tr>
                     <th scope="col"></th>
                     <th scope="col">TIN</th>
                     <th scope="col">state</th>
                     
                </tr>
                </tr>
            </thead>
            <tbody>
            <?php 
            
        if(!empty($tin))
        {
            if(!isset($tin[0]))
            {
                    echo "<tr id=\"".$tin['tin'].$tin['state']."\">";
                    echo "<td><i class=\"icon-cancel\" style=\"color:red;\"  onclick =\"deleteTin('".$tin['tin']."','".$tin['state']."');\"></i></td>";
                    echo "<td>".$tin['tin']."</td>";
                    echo "<td>".$tin['state']."</td>";
                    
                    echo "</tr>";
            }

            else
            {
            for($i = 0 ; $i < count($tin) ; $i++)
                {

                     echo "<tr id=\"".$tin[$i]['tin'].$tin[$i]['state']."\">";
                    echo "<td><i class=\"icon-cancel\" style=\"color:red;\"  onclick =\"deleteTin('".$tin[$i]['tin']."','".$tin[$i]['state']."');\"></i></td>";
                    echo "<td>".$tin[$i]['tin']."</td>";
                    echo "<td>".$tin[$i]['state']."</td>";
                    
                    echo "</tr>";
            
                }
            }
        }  

            ?>




            </tbody>
            

        </table>
    </li>


    <li id="add_button">
        <center><button class="submit bg-color-green fg-color-white"  id="create1">Add Tin details</button>
       
        
    </li>


	</ul>
	








 </section>
       
</section>

	
<footer style="position:fixed;bottom:0;height:2%;">

created by Mayank Bhola . copyright (C) Mayank Bhola 2013 . All rights reserved.

</footer>

</body>

</html>