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

	function validatePan(id) {
		if(typeof(id)==='undefined')
			field = $('#pan');
		else
			field = $('#'+id);
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


$("#name").keyup(function() {

		validateText(this);
	});

	$("#cpan").keyup(function() {

		validatePan('cpan');
	});

	$("#cin").keyup(function() {

		notEmpty(this);
	});

	$("#tax").keyup(function() {

		notEmpty(this);
	});

	$("#nature").keyup(function() {

		notEmpty(this);
	});


$('#submit').click(function() {
		//event.preventDefault();
		//alert(edited);
		//alert("message");
		/*
		if(typeof edited ==='undefined')
		{
		// no action					
		}
		else {
			alert(id);
			
			$.ajax({ 
             url : "deleteCompany.php?id="+id,
             async : false,
         	});

		}
		*/
		var error = '';

		error += validateText(document.getElementById('name'));
		error += validatePan('cpan');
		error += notEmpty(document.getElementById('cin'));
		error += notEmpty(document.getElementById('tax'));
		
		
		
		
		var nature = document.getElementById('nature');
		if(nature.value != "")
		{
			error += notEmpty(nature);
		
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