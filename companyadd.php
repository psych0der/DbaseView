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

    


    $values = array('',$name,$doi,$cin,$nature,$cpan,$tax,0);

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
	<title>Add company</title>
    <link rel="stylesheet" href="css/datepicker.css" type="text/css" />
	<link href="css/modern.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <link href="css/formstyle.css" rel="stylesheet">
    <link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">

    <script type="text/javascript" src="js/jquery2.js"></script>
    <script type="text/javascript" src="js/datepicker.js"></script>
    
    <script type="text/javascript" src="js/jqueryui.js"></script>

    <script type="text/javascript">
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
            <li><a href="clients.php"><i class="icon-stats-up"></i>Companies</a></li>
            
        </ul>
 	</section>

 </aside>
 

 <section id="content">
<?php
    if(isset($insertFlag) and $insertFlag ==false)
    {
    echo $db->error();
    echo "<h4><center><span class=\"label important\">Database Error : </span>"." ".$error."</center></h4>";
     

    }
    ?>

<div class="form">
<form class="add" id="cadd1" action="" method="post" novalidate>
	<ul>
    <li>
         <header class="head">
			<span>Add a company</span>
		</header>
         <span class="required_notification">* Denotes Required Field</span>
    </li>
    <li>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="John" class="custom-input name" required/>
        
    </li>
	
	

    <li>
        <label for="doi">Date of incorporation:</label>
        <input type="text" name="doi" placeholder="doi" id="doi" class="custom-input name" value = "1992-07-03"required/>
        
    </li>

    
    <li>
        <label for="cpan">PAN:</label>
        <input type="text" id="cpan" name="cpan" placeholder="pan number" class="custom-input name"  required/>
        <span class="form_hint">Proper format "AAAAA9999A"</span>
    </li>

    <li>
        <label for="tax">tax:</label>
        <input type="text" id = "tax" name="tax" placeholder="tax " class="custom-input name" required />
        
    </li>
     <li>
        <label for="cin">CIN:</label>
        <input type="text" id = "cin" name="cin" placeholder="CIN" class="custom-input name " required />
        
    </li>
    

    

	

	<li>
    	<label for="nature">Nature of Product/Service:</label>
    	<textarea  id="nature" name="nature" placeholder="about company" class="custom-input name">
        </textarea>
    	
	</li>

	

    
	
	<li>
    	<button class="submit bg-color-green fg-color-white" type="submit" id="submit">Submit Form</button>
    	<button class="submit bg-color-blue fg-color-white" type="reset">Reset Fields</button>
	</li>

	</ul>
	
</form>

</div>

 </section>

 <footer >

created by Mayank Bhola . copyright (C) Mayank Bhola 2013 . All rights reserved.

</footer>
       
</section>
	


</body>

</html>