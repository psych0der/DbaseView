jQuery(document).ready(function($) {

	function validateText(field) {

		field.required = false;
		$(field).removeClass('valid invalid');
		if (field.value != "") {
			if (field.value.match("[a-zA-Z]+")) {
				$(field).addClass('valid');
				return "";
			} else {
				$(field).addClass('invalid');
				return field.name + ' :invalid string format.\n';
			}
		} else {
			$(field).addClass('invalid');
			return field.name + ' :invalid string format.\n';
		}

	};

	function nan(field) {
		field.required = false;
		$(field).removeClass('valid invalid');

		if (isNaN(field.value) || field.value == "") {
			$(field).addClass('invalid');
			return field.name + ' :invalid number.\n';
		} else {
			$(field).addClass('valid');
			return "";
		}

	}

	function notEmpty(field) {
		field.required = false;
		$(field).removeClass('valid invalid');


		if (field.value != "") {
			$(field).addClass('valid');
			return "";

		} else {
			$(field).addClass('invalid');
			return field.name + ' :invalid format.\n';
		}

	}

	function validatePan() {
		field = $('#pan');
		field.removeAttr('required');
		field.removeClass('valid invalid');

		if (/[A-Z]{5}\d{4}[A-Z]/.test(field.val())) {
			$(field).addClass('valid');
			return "";

		} else {
			$(field).addClass('invalid');
			return 'invalid pan.\n';
		}
	}

	function validateDin() {
		field = $('#din');
		field.removeAttr('required');
		field.removeClass('valid invalid');

		if (field.val().length == 10) {
			$(field).addClass('valid');
			return "";

		} else {
			$(field).addClass('invalid');
			return 'invalid din.\n';
		}
	}

	function validateEmail(field) {
		field.required = false;
		$(field).removeClass('valid invalid');

		if (/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(field.value)) {
			$(field).addClass('valid');
			return "";

		} else {
			$(field).addClass('invalid');
			return 'invalid email.\n';
		}


	}

	function validateMobile(field) {

		field.required = false;
		$(field).removeClass('valid invalid');

		if (/((\+91-)|0)\d{10}/.test(field.value)) {
			$(field).addClass('valid');
			return "";

		} else {
			$(field).addClass('invalid');
			return 'invalid mobile.\n';


		}
	}

	function validateUrl(field) {
		field.required = false;
		$(field).removeClass('valid invalid');

		if (/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/.test(field.value)) {
			$(field).addClass('valid');
			return "";

		} else {
			$(field).addClass('invalid');
			return 'invalid weburl.\n';
		}


	}


	/* Attaching callbacks */

	$("#fname").keyup(function() {

		validateText(this);
	});

	$("#mname").keyup(function() {

		validateText(this);
	});

	$("#lname").keyup(function() {

		validateText(this);
	});


	$("#ffname").keyup(function() {

		validateText(this);
	});

	$("#fmname").keyup(function() {

		validateText(this);
	});

	$("#flname").keyup(function() {

		validateText(this);
	});

	$("#mfname").keyup(function() {

		validateText(this);
	});

	$("#mmname").keyup(function() {

		validateText(this);
	});

	$("#mlname").keyup(function() {

		validateText(this);
	});

	$("#house").keyup(function() {

		notEmpty(this);

	});

	$("#colony").keyup(function() {

		validateText(this);
	});

	$("#city").keyup(function() {

		validateText(this);
	});

	$("#state").keyup(function() {

		validateText(this);
	});

	$("#pincode").keyup(function() {

		nan(this);
	});

	$("#company").keyup(function() {

		validateText(this);
	});

	$("#pan").keyup(function() {

		validatePan();
	});

	$("#din").keyup(function() {

		validateDin();
	});

	$("#email1").keyup(function() {

		validateEmail(this);
	});

	$("#email2").keyup(function() {

		validateEmail(this);
	});

	$("#mobile1").keyup(function() {

		validateMobile(this);
	});

	$("#mobile2").keyup(function() {

		validateMobile(this);
	});

	$("#phone1").keyup(function() {

		notEmpty(this);
	});

	$("#phone2").keyup(function() {

		notEmpty(this);
	});

	$("#url").keyup(function() {

		validateUrl(this);
	});

	$("#username").keyup(function() {

		validateText(this);
	});

	$("#password").keyup(function() {

		validateText(this);
	});


	$('#submit').click(function() {
		//event.preventDefault();
		//alert(edited);


		
		if(typeof edited ==='undefined')
		{

			
			
		}
		else {
			
			
			$.ajax({ 
             url : "delete.php?id="+id,
             async : false,
         	});

		}
		var error = '';

		error += validateText(document.getElementById('fname'));

		var mname = document.getElementById('mname');
		if (mname.value != "")
			error += validateText(mname);

		var lname = document.getElementById('lname');
		if (lname.value != "")
			error += validateText(lname);

		error += validateText(document.getElementById('ffname'));

		var fmname = document.getElementById('fmname');
		if (fmname.value != "")
			error += validateText(fmname);

		var flname = document.getElementById('flname');
		if (flname.value != "")
			error += validateText(flname);

		error += validateText(document.getElementById('mfname'));

		var mmname = document.getElementById('mmname');
		if (mmname.value != "")
			error += validateText(mmname);

		var mlname = document.getElementById('mlname');
		if (mlname.value != "")
			error += validateText(mlname);


		error += notEmpty(document.getElementById('house'));

		var colony = document.getElementById('colony');
		if (colony.value != "")
			error += validateText(colony);

		error += validateText(document.getElementById('state'));

		var city = document.getElementById('city');
		if (city.value != "")
			error += validateText(city);

		error += nan(document.getElementById('pincode'));
		var company = document.getElementById('company');
		if (company.value != "")
			validateText(company);

		error += validatePan();
		error += validateDin();
		error += validateEmail(document.getElementById('email1'));
		var email2 = document.getElementById('email2');
		if (email2.value != "")
			error += validateEmail(email2);


		error += validateMobile(document.getElementById('mobile1'));

		var mobile2 = document.getElementById('mobile2');
		if (mobile2.value != "")
			error += validateMobile(mobile2);



		error += notEmpty(document.getElementById('phone1'));

		var phone2 = document.getElementById('phone2');
		if (phone2.value != "")
			error += notEmpty(phone2);

		var url = document.getElementById('url');
		if(url.value != "")
		{
			error += validateUrl(url);
		
		}//error += validateText(document.getElementById('username'));
		//error += validateText(document.getElementById('password'));


		if (error != '') {


			var span = document.createElement('span');
			span.className = 'label important';
			span.id = 'error-span';


			var text1 = document.createTextNode('Errors : Please correct errors and resubmit form');
			span.appendChild(text1);


			var parent = document.getElementById('content');

			if (document.getElementById('error-span'))
				parent.removeChild(document.getElementById('error-span'));

			parent.appendChild(span);
			parent.insertBefore(span, parent.firstChild);


			//alert('errors : \n'+error);
			return false;
		} else {

			var span = document.createElement('span');
			span.className = 'label success';
			span.id = 'error-span';


			var text1 = document.createTextNode('Success : Record has been succesfully added to database');
			span.appendChild(text1);

			var parent = document.getElementById('content');

			if (document.getElementById('error-span'))
				parent.removeChild(document.getElementById('error-span'));

			parent.appendChild(span);
			parent.insertBefore(span, parent.firstChild);
			


		}

	});



});