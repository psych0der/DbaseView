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

if ( !(empty($_POST)))
{
    
    $title = $_POST['title'];
    $fname = $_POST['fname'];
    $ffname = $_POST['ffname'];
    $mfname = $_POST['mfname'];
    $house = $_POST['house'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $dob = $_POST['dob'];
    $pan = $_POST['pan'];
    $din = $_POST['din'];
    $email = $_POST['email1'];
    $mobile = $_POST['mobile1'];
    $phone = $_POST['phone1'];

    

    if(isset($_POST['mname']) && ! empty($_POST['mname']))
        $mname = $_POST['mname'];
    else
        $mname = '';

    if(isset($_POST['lname']) && ! empty($_POST['lname']))
        $lname = $_POST['lname'];
    else
        $lname = '';

    if(isset($_POST['fmname']) && ! empty($_POST['fmname']))
        $fmname = $_POST['fmname'];
    else
        $fmname = '';

    if(isset($_POST['flname']) && ! empty($_POST['flname']))
        $flname = $_POST['flname'];
    else
        $flname = '';

    if(isset($_POST['mmname']) && ! empty($_POST['mmname']))
        $mmname = $_POST['mmname'];
    else
        $mmname = '';

    if(isset($_POST['mlname']) && ! empty($_POST['mlname']))
        $mlname = $_POST['mlname'];
    else
        $mlname = '';

    if(isset($_POST['colony']) && ! empty($_POST['colony']))
        $colony = $_POST['colony'];
    else
        $colony = '';

    if(isset($_POST['city']) && ! empty($_POST['city']))
        $city = $_POST['city'];
    else
        $city = '';

    if(isset($_POST['company1']) && ! empty($_POST['company1']))
        $company = $_POST['company1'];
    else
    {
        if(isset($_POST['company2']) && ! empty($_POST['company2']))
            $company = $_POST['company2'];
        else
            $company = '';
        
    }

    if(isset($_POST['email2']) && ! empty($_POST['email2']))
        $email2 = $_POST['email2'];
    else
        $email2 = '';

    if(isset($_POST['mobile2']) && ! empty($_POST['mobile2']))
        $mobile2 = $_POST['mobile2'];
    else
        $mobile2 = '';

    if(isset($_POST['phone2']) && ! empty($_POST['phone2']))
        $phone2 = $_POST['phone2'];
    else
        $phone2 = '';

    if(isset($_POST['url']) && ! empty($_POST['url']))
        $url = $_POST['url'];
    else
        $url = '';


    $values = array('',$title,$fname,$mname,$lname,$house,$colony,$city,$state,$pincode,$ffname,$fmname,$flname,$mfname,$mmname,$mlname,$dob,$company,$pan,$din,$email,$email2,$mobile,$mobile2,$phone,$phone2,$url);

    $insertFlag = $db->insert('client',$values);

    if(!$insertFlag)
        echo $db->error();


}



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
     
        $('#dob').DatePicker({
        format:'Y-m-d',
        date: "1992-07-03",
        current: "1992-07-03",
        starts: 1,
        position: 'right',
        onBeforeShow: function(){
            $('#dob').DatePickerSetDate($('#dob').val(), true);
        },
        onChange: function(formated, dates){
            $('#dob').val(formated);
            if ($('#closeOnSelect input').attr('checked')) {
                $('#dob').DatePickerHide();
            }
        }
    });
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

<div class="form">
<form class="add" id="cadd" action="" method="post" novalidate>
	<ul>
    <li>
         <header class="head">
			<span>Add a client</span>
		</header>
         <span class="required_notification">* Denotes Required Field</span>
    </li>
    <li>
        <label for="name">Name:</label>
        <select name="title" class="select">
            <option value="Mr.">Mr.</option>
            <option value="Mrs.">Mrs.</option>
            <option value="Ms.">Ms.</option>
        </select>

        <input type="text" id="fname" name="fname" placeholder="John" class="custom-input name" required/>
        <input type="text" id = "mname" name="mname" placeholder="Michell" class="custom-input name"/>
        <input type="text" id = "lname" name="lname" placeholder="doe" class="custom-input name"/>
    </li>
	
	<li>
        <label for="name">Address:</label>
        <input type="text" id="house" name="house" placeholder="house/flat number" class="custom-input name" required/>
        <input type="text" id="colony" name="colony" placeholder="colony" class="custom-input name"/>
        <input type="text" id="city" name="city" placeholder="city" class="custom-input name"/>
    </br>
    </br>

    	<div class="row">
    	<input type="text" id="state" name="state" placeholder="state" class="custom-input name " required/>
        <input type="text" id= "pincode" name="pincode" placeholder="pincode" class="custom-input name " required/>
		</div>
    </li>

    <li>
        <label for="name">Father's Name:</label>
       
        <input type="text" id="ffname" name="ffname" placeholder="John" class="custom-input name" required/>
        <input type="text" id="fmname" name="fmname" placeholder="Michell" class="custom-input name"/>
        <input type="text" id="flname" name="flname" placeholder="doe" class="custom-input name"/>
    </li>

    <li>
        <label for="name">Mother's Name:</label>
        <input type="text" id="mfname" name="mfname" placeholder="Mary" class="custom-input name" required/>
        <input type="text" id="mmname" name="mmname" placeholder="Michell" class="custom-input name"/>
        <input type="text" id="mlname" name="mlname" placeholder="doe" class="custom-input name"/>
    </li>

    <li>
        <label for="dob">Date of Birth:</label>
        <input type="text" name="dob" placeholder="birthdate" id="dob" class="custom-input name" value = "1992-07-03"required/>
        
    </li>

    <li>
        <label for="comapny">Company:</label>
       Exisitng company : 
       <select name="company1" class="select company">
            <!-- filled through php -->
        </select>
    </br>
</br>
    OR
</br>

        <input type="text" id= "company" name="company2" placeholder="company not listed"  class="custom-input name row" width="350px"/>
        
    </li>

    <li>
        <label for="pan">PAN:</label>
        <input type="text" id="pan" name="pan" placeholder="pan number" class="custom-input name"  required/>
        <span class="form_hint">Proper format "AAAAA9999A"</span>
    </li>

    <li>
        <label for="din">DIN:</label>
        <input type="text" id = "din" name="din" placeholder="din " class="custom-input name"  required/>
        
    </li>
    

	<li>
    	<label for="email1">Email:</label>
    	<input type="email" id="email1" name="email1" placeholder="name@example.com" class="custom-input name"  required/>
    	<span class="form_hint">Proper format "name@something.com"</span>
	</li>

    <li>
        <label for="email2">Alternate Email:</label>
        <input type="email" id="email2" name="email2" placeholder="name@example.com" class="custom-input name" />
        <span class="form_hint">Proper format "name@something.com"</span>
    </li>

    <li>
        <label for="mobile1">Mobile #:</label>
        <input type="text" id="mobile1" name="mobile1" placeholder="09999999999" class="custom-input name"  required/>
        <span class="form_hint">Proper format "+91-9999999999 or 09999999999"</span>
    </li>

    <li>
        <label for="mobile2">Alternate Mob. #:</label>
        <input type="text" id="mobile2" name="mobile2" placeholder="09999999999" class="custom-input name" />
        <span class="form_hint">Proper format "+91-9999999999 or 09999999999"</span>
    </li>


    <li>
        <label for="phone1">Phone #:</label>
        <input type="text" id="phone1" name="phone1" placeholder="0120-2647166" class="custom-input name"  required/>
        <span class="form_hint">Proper format "0120-2647166"</span>
    </li>

    <li>
        <label for="phone2">Phone #:</label>
        <input type="text" id="phone2" name="phone2" placeholder="09999999999" class="custom-input name" />
        <span class="form_hint">Proper format "+91-9999999999 or 09999999999"</span>
    </li>


	<li>
    	<label for="website">Website:</label>
    	<input type="url" id="url" name="url" placeholder="www.example.com" class="custom-input name"/>
    	<span class="form_hint">Proper format "http://someaddress.com"</span>
	</li>

	

    
	
	<li>
    	<button class="submit bg-color-green fg-color-white" type="submit" id="submit">Submit Form</button>
    	<button class="submit bg-color-blue fg-color-white" type="reset">Reset Fields</button>
	</li>

	</ul>
	
</form>

</div>

 </section>
       
</section>
	
<footer>

created by Mayank Bhola . copyright (C) Mayank Bhola 2013 . All rights reserved.

</footer>

</body>

</html>