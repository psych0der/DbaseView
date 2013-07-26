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
    $response = $db->select('client',false,'*',"id=$id",null);
    if($response)
        $user = $db->getResult();
    else
    {
        $db->error();
        $flag = false;
    }

    if(empty($user))
        $flag = false;
}

?>
<!--- FORM MARKUP -->


<!html>
<head>
	<title><?php  echo $user['s_first']." ".$user['s_last'];   ?></title>
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
    var miniform = $('<div id="custom-input" class="form"><form id="form2" class="sadd"><ul id="custom-ul"><li><input type="text" id="service" name="service" placeholder="gmail.com" class="custom-input name " required/><input type="text" id= "usname" name="usname" placeholder="username" class="custom-input name " required/><input type="text" id= "pswd" name="pswd" placeholder="password" class="custom-input name " required/><button class="submit bg-color-blue fg-color-white" id="ajax-insert" >add</button></li></ul></form></div>');
    miniform.insertAfter($('#add_button'));
    $('#ajax-insert').click(clickEvent);

    });


    var clickEvent = function(event){
        event.preventDefault();
        var serv = $('#service').val();
        var uname = $('#usname').val();
        var pswd = $('#pswd').val();
        $.get( 
             "insert_credential.php",
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
             echo $user['s_title'];
             if($user['s_middle']!="")
             {
                echo " ".$user['s_first']." ".$user['s_middle']." ".$user['s_last'];

             }
             else
                echo " ".$user['s_first']." ".$user['s_last'];

            ?>
            </span>
            <?php
                if($user['verified'] ==1)
                {
                    echo "<span class=\"label success\" style=\"float:right;font-size:1em;\" >Verified</span>";
                }
                else
                    echo "<span class=\"label important\" style=\"float:right;font-size:1em;\" >Unverified</span>";
             ?>
		</header>
         
    </li>
    <?php 
    if($user['f_first']!="")
    {
    ?>
    <li>
        
        <div id="info-block">
        <?php 

             echo "Father's Name :";
             echo "<span id=\"info\">";
             echo 'Mr.';
             if($user['f_middle']!="")
             {
                echo " ".$user['f_first'].$user['f_middle'].$user['f_last'];

             }
             else
                echo " ".$user['f_first'].$user['f_last'];

            ?>
        </span>
        </div>
        
    </li>
    <?php
    }
    ?>

     <?php 
    if($user['m_first']!="")
    {
    ?>
	
	<li>
        
        <div id="info-block">
        <?php 

             echo "Mothers's Name :";
             echo "<span id=\"info\">";
             echo 'Mrs.';
             if($user['m_middle']!="")
             {
                echo " ".$user['m_first'].$user['m_middle'].$user['m_last'];

             }
             else
                echo " ".$user['m_first'].$user['m_last'];

            ?>
        </span>
        </div>
    </li>
    <?php
    }
    ?>

    <li>
        <div id="info-block">
        <?php 

             echo "Address :";
             echo "<span id=\"info\">";
             echo " ".$user['house'];
             if($user['colony']!="")
                echo ', '.$user['colony'];
            if($user['city']!="")
                echo ', '.$user['city'];

            echo ', '.$user['state'].', '.$user['pin'];
            
             

        ?>
        </span>
        </div>
    </li>

    <li>
        <div id="info-block">
        <?php 

             echo "Date of Birth :";
             echo "<span id=\"info\">";
             echo "<i>".$user['dob']."</i>";
        ?>

        </span>
        </div>
    </li>

    <li>
        <div id="info-block">
        <?php 

             echo "Company :";
             echo "<span id=\"info\">";
             
             if(is_numeric($user['company']))
             {

                $res = $db->select('company',false,'name',"id=".$user['company'],null);
                 if($res) 
                 {
                    $com = $db->getResult();
                    echo "<a href=\"showcompany.php?id=".$user['company']."\">".$com['name']."</a>";
                }
             }
             
             else
                echo $user['company'];
        ?>
        
        </span>
        </div>
        
    </li>

    <li>
        
       <div id="info-block">
        <?php 

             echo "PAN :";
             echo "<span id=\"info\" class=\"fg-color-red\">";
             echo $user['pan'];
        ?>
        
        </span>
        </div>
        
    </li>
    <?php 
        if($user['din']!= "")
        {
    ?>
    <li>
        <div id="info-block">
        <?php 

             echo "DIN :";
             echo "<span id=\"info\" class=\"fg-color-red\">";
             echo $user['din'];
        ?>
        
        </span>
        </div>
        
    </li>
    <?php
    }
    ?>

    
    <li>
        <div id="info-block">
        <?php 

             echo "Email :";
             echo "<a id=\"info\" class=\"navigation-text\">";
             echo $user['email1'];
        ?>
        
        </a>
        </div>
        
        
    </li>
    
    <?php
    if($user['email2']!="")
    {
    ?>
    
    <li>
        <div id="info-block">
        <?php 

             echo "Secondary Email :";
             echo "<a id=\"info\" class=\"navigation-text\">";
             echo $user['email2'];
        ?>
        
        </a>
        </div>
        
    </li>
    <?php
    }
    ?>


    <li>
        <div id="info-block">
        <?php 

             echo "Mobile # :";
             echo "<span id=\"info\">";
             echo $user['mobile1'];
        ?>
        
        </span>
        </div>
        
        
    </li>
    
    <?php
    if($user['mobile2']!="")
    {
    ?>
    
    <li>
        <div id="info-block">
        <?php 

             echo "Alternate Mobile # :";
             echo "<span id=\"info\" >";
             echo $user['mobile2'];
        ?>
        
        </span>
        </div>
        
    </li>
    <?php
    }
    ?>

    <?php
    if($user['url']!="")
    {
    ?>
     <li>
        <div id="info-block">
        <?php 

             echo "Website :";
             echo "<a id=\"info\" class=\"navigation-text\">";
             echo $user['url'];
        ?>
        
        </a>
        </div>
        
        
    </li>
    <?php
    }
    ?>


    <li>
        <div id="info-block">
        <?php 

             echo "Phone # :";
             echo "<span id=\"info\">";
             echo $user['phone1'];
        ?>
        
        </span>
        </div>
        
        
    </li>
    
    <?php
    if($user['phone2']!="")
    {
    ?>
    
    <li>
        <div id="info-block">
        <?php 

             echo "Alternate phone # :";
             echo "<span id=\"info\" >";
             echo $user['phone2'];
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
    $response = $db->select('user_account',false,'*',"id=$id",null);
    if($response)
        $credential = $db->getResult();




    ?>
    <li>
        <table class="striped">
            <caption>Login Credentials</caption>
            <thead>
                <tr>
       
                     <th scope="col">Service</th>
                     <th scope="col">username</th>
                     <th scope="col">password</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            
        if(!empty($credential))
        {
            if(!isset($credential[0]))
            {
                echo "<tr>";
                    echo "<td>".$credential['account_type']."</td>";
                    echo "<td>".$credential['username']."</td>";
                    echo "<td>".$credential['password']."</td>";
                    echo "</tr>";
            }

            else
            {
            for($i = 0 ; $i < count($credential) ; $i++)
                {
                    echo "<tr>";
                    echo "<td>".$credential[$i]['account_type']."</td>";
                    echo "<td>".$credential[$i]['username']."</td>";
                    echo "<td>".$credential[$i]['password']."</td>";
                    echo "</tr>";
            
                }
            }
        }  

            ?>




            </tbody>
            

        </table>
    </li>

    <li id="add_button">
        <center><button class="submit bg-color-green fg-color-white"  id="create1">Add credential</button>
        <a href=<?php echo "\"clientedit.php?id=$id\""?>><button style="margin-left:-1px;" class="submit bg-color-blue fg-color-white"  id="create2">EDIT</button></a></center>
        
    </li>


	</ul>
	


<?php

}
?>





 </section>
       
</section>
	
<footer style="position:relative;height:10px;">

created by Mayank Bhola . copyright (C) Mayank Bhola 2013 . All rights reserved.

</footer>

</body>

</html>