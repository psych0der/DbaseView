<?php  
  
/**
 * Copyright information
 * @author Mayank Bhola <mayankbhola@gmail.com>
 * @copyright Copyright (c) 2013, Mayank Bhola
 * @version 0.9 
 */
  
?>
<!--- FORM MARKUP -->


<!html>
<head>
	<title>dBaseViewer</title>
    <link rel="stylesheet" href="css/datepicker.css" type="text/css" />
	<link href="css/modern.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <link href="css/formstyle.css" rel="stylesheet">

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/datepicker.js"></script>
    <script type="text/javascript" src="js/clientvalidate.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
     /*  $('#dob').DatePicker({
    format:'m/d/Y',
    date: '2008-07-31',
    current: '2008-07-31',
    calendars: 1,
    starts: 1,
    position: 'r',
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
*/
$('#dob').DatePicker({
    format:'m/d/Y',
    date: "06/07/1992",
    current: "06/7/1992",
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
        <input type="text" id = "mname" name="mname" placeholder="Michell" class="custom-input name" required/>
        <input type="text" id = "lname" name="lname" placeholder="doe" class="custom-input name" required/>
    </li>
	
	<li>
        <label for="name">Address:</label>
        <input type="text" id="house" name="house" placeholder="house/flat number" class="custom-input name" required/>
        <input type="text" id="colony" name="colony" placeholder="colony" class="custom-input name" required/>
        <input type="text" id="city" name="city" placeholder="city" class="custom-input name" required/>
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
        <input type="text" id="fmname" name="fmname" placeholder="Michell" class="custom-input name" required/>
        <input type="text" id="flname" name="flname" placeholder="doe" class="custom-input name" required/>
    </li>

    <li>
        <label for="name">Mother's Name:</label>
        <input type="text" id="mfname" name="mfname" placeholder="Mary" class="custom-input name" required/>
        <input type="text" id="mmname" name="mmname" placeholder="Michell" class="custom-input name" required/>
        <input type="text" id="mlname" name="mlname" placeholder="doe" class="custom-input name" required/>
    </li>

    <li>
        <label for="dob">Date of Birth:</label>
        <input type="text" name="dob" placeholder="birthdate" id="dob" class="custom-input name" value = "06/07/1992"required/>
        
    </li>

    <li>
        <label for="comapny">Company:</label>
       Exisitng company : 
       <select name="company" class="select company">
            <!-- filled through php -->
        </select>
    </br>
</br>
    OR
</br>

        <input type="text" id= "company" name="company" placeholder="company not listed"  class="custom-input name row" width="350px"/>
        
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
        <label for="mobile2">Alternate Mobile #:</label>
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
    	<input type="url" id="url" name="website" placeholder="www.example.com" class="custom-input name" required/>
    	<span class="form_hint">Proper format "http://someaddress.com"</span>
	</li>

	

    <li>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="username" class="custom-input name"  required/>
        
    </li>

     <li>
        <label for="password">Password:</label>
        <input type="text" id="password" name="password" placeholder="password" class="custom-input name"  required/>
        
    </li>
	
	<li>
    	<button class="submit bg-color-green fg-color-white" type="submit">Submit Form</button>
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