<?php  
  
/**
 * Copyright information
 * @author Mayank Bhola <mayankbhola@gmail.com>
 * @copyright Copyright (c) 2013, Mayank Bhola
 * @version 0.9 
 */
  
ob_start();

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


if ( !(empty($_POST)))
{
    

    $name = $_POST['name'];
    $cpan = $_POST['cpan'];
    $tax = $_POST['tax'];
    $cin = $_POST['cin'];
    $doi = $_POST['doi'];

    if(isset($_POST['nature']) && ! empty($_POST['nature']))
        $nature = $_POST['nature'];
    else
        $nature = '';


    

   $values = array('',$name,$doi,$cin,$nature,$cpan,$tax);

    $insertFlag = $db->insert('company',$values);

    if(!$insertFlag)
      $error =  $db->error();

    $response = $db->select('company',false,'id',"pan='$cpan'",null);
    if($response)
        $id = $db->getResult();
    else
        echo $db->error();
    

    if($insertFlag)
        header('Location: showcompany.php?id='.$id['id']);

    ob_flush();


}
?>
<!--- FORM MARKUP -->


<!html>
<head>
	<title>Edit Record</title>
    <link rel="stylesheet" href="css/datepicker.css" type="text/css" />
	<link href="css/modern.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <link href="css/formstyle.css" rel="stylesheet">
    <link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">

    <script type="text/javascript" src="js/jquery2.js"></script>
    <script type="text/javascript" src="js/datepicker.js"></script>
    <script type="text/javascript" src="js/typeahead.min.js"></script>
    <script type="text/javascript" src="js/jqueryui.js"></script>
    

    <script type="text/javascript">
    var edited = 1;
    var id = <?php echo $id;?>;

    function deleteDirector(client_id,cdoi)
    {
        var r = confirm('Are you sure you want to delete the director');
        if(r==true)
        {
            
             $.ajax({ 
                 url : "delete-director.php?client="+client_id+"&doi="+cdoi,
                async : false,
                });
            $('#'+client_id+cdoi).remove();
        }
        
    
    };


    $(document).ready(function() {

        
        
     
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

    $('#delete').click(function(){

        event.preventDefault();
        var response =confirm("Are you sure you want to delete the record");

       if(response == true)
       {
       $.get( 
             "deleteCompany.php",
             { id :<?php echo $id; ?>},
             function(data) {

                if(data == 1)
                {
                  alert('deleted');
                    window.location = "./companies.php";
                }
             }

          );
        }
    });

        
});
    </script>
    <script type="text/javascript" src="js/companyvalidate.js"></script>

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

    if(isset($insertFlag) and $insertFlag ==false)
    {
    echo $db->error();
    echo "<h4><center><span class=\"label important\">Database Error : </span>"." ".$error."</center></h4>";
     

    }
    ?>

<div class="form">
<form class="add" id="cadd" action="" method="post" novalidate>
	<ul>
    <li>
         <header class="head">
			<span>Edit details</span>
		</header>
         <span class="required_notification">* Denotes Required Field</span>
    </li>
    <li>
        <label for="name">Name:</label>
        

        <input type="text" id="name" name="name" placeholder="John" class="custom-input name" value = <?php echo '"'.$company['name'].'"';?>required/>
       
        
    </li>
	
	<li>
        <label for="name">CIN:</label>
        <input type="text" id="cin" name="cin" placeholder="CIN" class="custom-input name" value = <?php echo '"'.$company['cin'].'"';?> required/>
        
       
    </li>

    <li>
        <label for="name">Tax Number:</label>
       
        <input type="text" id="tax" name="tax" placeholder="John" class="custom-input name" value = <?php echo '"'.$company['tax'].'"';?> required/>
        
       
        
    </li>

    <li>
        <label for="name">DOI:</label>
        <input type="text" id="doi" name="doi" placeholder="Mary" class="custom-input name" value = <?php echo '"'.$company['doi'].'"';?> required/>
       
    </li>

    

    

    <li>
        <label for="nature">Nature:</label>
        <?php 
        if(isset($company['nature']))
        {
        ?>
       <textarea  id="nature" name="nature" placeholder="about company" class="custom-input name"><?php echo $company['nature'];?></textarea>
        <?php
        }
        else
        {
        ?>
        <textarea  id="nature" name="nature" placeholder="about company" class="custom-input name">
        </textarea>
        <?php
        }
        ?>
        
        
    </li>

    
    <?php
        $res = $db->select('lod',false,'*',"`comp-id`=$id",null);
        if($res)
            $director = $db->getResult();
    ?>

    <li>
        <table class="striped" id="cred-table">
            <caption>List Of Director</caption>
            <thead>
                <tr>
                     <th scope="col"></th>
                     <th scope="col">Director</th>
                     <th scope="col">DOI</th>
                     <th scope="col">DOC</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            
        if(!empty($director))
        {
            if(!isset($director[0]))
            {
                $res = $db->select('client',false,'s_first',"id=".$director['client-id'],null);
                 if($res)
                    $cl = $db->getResult();

                echo "<tr id=\"".$director['client-id'].$director['doi']."\">";
                    echo "<td><i class=\"icon-cancel\" onclick =\"deleteDirector('".$director['client-id']."','".$director['doi']."');\"></i></td>";
                    echo "<td>".$cl['s_first']."</td>";
                    echo "<td>".$director['doi']."</td>";
                    echo "<td>".$director['doc']."</td>";
                    echo "</tr>";
            }

            else
            {
            for($i = 0 ; $i < count($director) ; $i++)
                {
                    $res = $db->select('client',false,'s_first',"id=".$lod['client-id'],null);
                 if($res)
                    $cl = $db->getResult();

                echo "<tr id=\"".$director[$i]['client-id'].$director[$i]['doi']."\">";
                    echo "<td><i class=\"icon-cancel\" onclick =\"deleteDirector('".$director[$i]['client-id']."','".$director[$i]['doi']."');\"></i></td>";
                    echo "<td>".$cl['s_first']."</td>";
                    echo "<td>".$director[$i]['doi']."</td>";
                    echo "<td>".$director[$i]['doc']."</td>";
                    echo "</tr>";
            
                }
            }
        }  

            ?>




            </tbody>
            

        </table>
    </li>
	

    
	
	<li>
    	<button class="submit bg-color-green fg-color-white" type="submit"  id="submit">Submit Form</button>
    	<button class="submit bg-color-red fg-color-white" id="delete" style="margin-left:-1px;">Delete</button>
	</li>

	</ul>
	
</form>

</div>
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