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
    
    function deleteServices(date,ackno)
         {
            
            var r = confirm('Are you sure you want to delete the service');
            if(r==true)
            {
            
             $.ajax({ 
                 url : "delete-company-service.php?date="+date+"&ack="+ackno,
                async : false,
                });
            $('#'+date+ackno).remove();
            }
        
    
        };
     


    $(document).ready(function() {

    $('#create1').click(function(){
    var miniform = $('<div id="custom-input" class="form"><form id="form2" class="sadd"><ul id="custom-ul"><li><input type="text" id="date" name="date" placeholder="1992-07-03" value ="1992-07-03" class="custom-input name " required/><input type="text" id= "ack" name="ack" placeholder="acknowledgment" class="custom-input name " required/><textarea  id= "memo" name="memo" placeholder="memo" class="custom-input name "></textarea><button class="submit bg-color-blue fg-color-white" id="ajax-insert" >add</button></li></ul></form></div>');
    var element =  document.getElementById('custom-input');
    if ( element == null)
    {
    miniform.insertAfter($('#add_button'));
    $('#ajax-insert').click(clickEvent);
    }

    $('#date').DatePicker({
        format:'Y-m-d',
        date: "1992-07-03",
        current: "1992-07-03",
        starts: 1,
        position: 'right',
        onBeforeShow: function(){
            $('#date').DatePickerSetDate($('#date').val(), true);
        },
        onChange: function(formated, dates){
            $('#date').val(formated);
            if ($('#closeOnSelect input').attr('checked')) {
                $('#date').DatePickerHide();
            }
        }
    });

    });


      var clickEvent = function(event){
        event.preventDefault();
        
        var date = $('#date').val();
        var ack = $('#ack').val();
        var memo = $('#memo').val();
        $.get( 
             "insert_company_service.php",
             { id :<?php echo $id; ?> ,date: date,ack : ack , memo : memo },
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
             echo "<a href=\"showcompany.php?id=$id\">".$company['name']." "."</a></br></br><h3><i>Services offered</i></h3>";
             
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
    $res1 = $db->select('cservices',false,'*',"`id`=$id",null);
    if($res1)
        $services = $db->getResult();
    else
        $db->error();




    ?>
    <li>
        <table class="striped">
            <caption>Credentials</caption>
            <thead>
                <tr>
                     <th scope="col"></th>
                     <th scope="col">Date</th>
                     <th scope="col">acknowledgment</th>
                     <th scope="col">Memo</th>
                </tr>
                </tr>
            </thead>
            <tbody>
            <?php 
            
        if(!empty($services))
        {
            if(!isset($services[0]))
            {
                    echo "<tr id=\"".$services['date'].$services['ackno']."\">";
                    echo "<td><i class=\"icon-cancel\" style=\"color:red;\"  onclick =\"deleteServices('".$services['date']."','".$services['ackno']."');\"></i></td>";
                    echo "<td>".$services['date']."</td>";
                    echo "<td>".$services['ackno']."</td>";
                    echo "<td>".$services['memo']."</td>";
                    echo "</tr>";
            }

            else
            {
            for($i = 0 ; $i < count($services) ; $i++)
                {

                    echo "<tr id=\"".$services[$i]['date'].$services[$i]['ackno']."\">";
                    echo "<td><i class=\"icon-cancel\" style=\"color:red;\"  onclick =\"deleteServices('".$services[$i]['date']."','".$services[$i]['ackno']."');\"></i></td>";
                    echo "<td>".$services[$i]['date']."</td>";
                    echo "<td>".$services[$i]['ackno']."</td>";
                    echo "<td>".$services[$i]['memo']."</td>";
                    echo "</tr>";
            
                }
            }
        }  

            ?>




            </tbody>
            

        </table>
    </li>


    <li id="add_button">
        <center><button class="submit bg-color-green fg-color-white"  id="create1">Add Service</button>
       
        
    </li>


	</ul>
	








 </section>
       
</section>

	
<footer style="position:fixed;bottom:0;height:2%;">

created by Mayank Bhola . copyright (C) Mayank Bhola 2013 . All rights reserved.

</footer>

</body>

</html>