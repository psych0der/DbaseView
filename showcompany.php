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
    $response = $db->select('company',false,'*',"id=$id",null);
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
    $(document).ready(function() {
     
    $('#create1').click(function(){
    <?php
    
    $clres = $db->select('client',false,'id,s_first',null,null,null);
    if(!$clres)
        echo $db->error();
    else
        $client = $db->getResult();

    $select = "<select id=\"director\" name =\"director\" class=\"custom-input select2\">";
    for($i=0;$i<count($client);$i++)
    {
        $select.= "<option value =\"".$client[$i]['id']."\">".$client[$i]['s_first']."</option>";
    }
    $select.="</select>";
    
    echo "var miniform = $('<div id=\"custom-input\" class=\"form\"><form id=\"form2\" class=\"sadd\"><ul id=\"custom-ul\"><li>".$select."<input type=\"text\" id=\"doi\" name=\"doi\" placeholder=\"\" class=\"custom-input name \" value = \"1992-07-03\" required/><input type=\"text\" id= \"doc\" name=\"doc\" placeholder=\"\" class=\"custom-input name  \" value = \"1992-07-03\" required /><button class=\"submit bg-color-blue fg-color-white\" id=\"ajax-insert\" >add</button></li></ul></form></div>')";
    ?>

    miniform.insertAfter($('#add_button'));
    $('#director').prop('selectedIndex', -1);
    
    $('#doi').DatePicker({
        format:'Y-m-d',
        date: "1992-07-03",
        current: "1992-07-03",
        starts: 1,
        position: 'right',
        onBeforeShow: function(){
            $('#doi').DatePickerSetDate($('#doi').val(), true);
        },
        onChange: function(formated, dates){
            $('#doi').val(formated);
            if ($('#closeOnSelect input').attr('checked')) {
                $('#doi').DatePickerHide();
            }
        }
    });

    $('#doc').DatePicker({
        format:'Y-m-d',
        date: "1992-07-03",
        current: "1992-07-03",
        starts: 1,
        position: 'right',
        onBeforeShow: function(){
            $('#doc').DatePickerSetDate($('#doc').val(), true);
        },
        onChange: function(formated, dates){
            $('#doc').val(formated);
            if ($('#closeOnSelect input').attr('checked')) {
                $('#doc').DatePickerHide();
            }
        }
    });

    $('#ajax-insert').click(clickEvent);

    });


    var clickEvent = function(event){
        event.preventDefault();
        var director = $('#director').val();
        var doi = $('#doi').val();
        var doc = $('#doc').val();
        $.get( 
             "insert_director.php",
             { id :<?php echo $id; ?> ,director: director,doi : doi , doc : doc },
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
             echo $company['name'];
             
            ?>
            </span>
		</header>
         
    </li>
     
    <li>
        
        <div id="info-block">
        <?php 

             echo "Date of inititation:";
             echo "<span id=\"info\">";
             echo $company['doi'];

            ?>
        </span>
        </div>
        
    </li>
    

     <li>
        
        <div id="info-block">
        <?php 

             echo "CIN:";
             echo "<span id=\"info\">";
             echo $company['cin'];

            ?>
        </span>
        </div>
        
    </li>

    <li>
        
        <div id="info-block">
        <?php 

             echo "PAN:";
             echo "<span id=\"info\">";
             echo $company['pan'];

            ?>
        </span>
        </div>
        
    </li>

    <li>
        
        <div id="info-block">
        <?php 

             echo "TAX number:";
             echo "<span id=\"info\">";
             echo $company['tax'];

            ?>
        </span>
        </div>
        
    </li>
    
    <?php
    if($company['nature']!="")
    {
    ?>
    
    <li>
        <div id="info-block">
        <?php 

             echo "Nature :";
            echo "<span id=\"info\">";
             echo $company['nature'];
        ?>
        
        </span>
        </div>
        
    </li>
    <?php
    }
    ?>


    
  	
    </br>
    </br>
    <?php
    $res1 = $db->select('lod',false,'*',"`comp-id`=$id",null);
    if($res1)
        $lod = $db->getResult();
    else
        $db->error();




    ?>
    <li>
        <table class="striped">
            <caption>List of directors</caption>
            <thead>
                <tr>
       
                     <th scope="col">Name</th>
                     <th scope="col">DOI</th>
                     <th scope="col">DOC</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            
        if(!empty($lod))
        {
            if(!isset($lod[0]))
            {
                 $res = $db->select('client',false,'s_first',"id=".$lod['client-id'],null);
                 if($response)
                    $cl = $db->getResult();
                echo "<tr>";
                    echo "<td><a href=\"showclient.php?id=".$lod['client-id']."\">".$cl['s_first']."</td>";
                    echo "<td>".$lod['doi']."</td>";
                    echo "<td>".$lod['doc']."</td>";
                    echo "</tr>";
            }

            else
            {
            for($i = 0 ; $i < count($lod) ; $i++)
                {

                    $res = $db->select('client',false,'s_first',"id=".$lod[$i]['client-id'],null);
                    if($response)
                        $cl = $db->getResult();
                    
                    echo "<tr>";
                    echo "<td><a href=\"showclient.php?id=".$lod[$i]['client-id']."\">".$cl['s_first']."</td>";
                    echo "<td>".$lod[$i]['doi']."</td>";
                    echo "<td>".$lod[$i]['doc']."</td>";
                    echo "</tr>";
            
                }
            }
        }  

            ?>




            </tbody>
            

        </table>
    </li>

    <li id="add_button">
        <center><button class="submit bg-color-green fg-color-white"  id="create1">Add Director</button>
        <a href=<?php echo "\"companyedit.php?id=$id\""?>><button style="margin-left:-1px;" class="submit bg-color-blue fg-color-white"  id="create2">EDIT</button></a></center>
        
    </li>


	</ul>
	


<?php

}
?>





 </section>
       
</section>
	</br></br>
<footer style="position:relative;height:10px;">

created by Mayank Bhola . copyright (C) Mayank Bhola 2013 . All rights reserved.

</footer>

</body>

</html>