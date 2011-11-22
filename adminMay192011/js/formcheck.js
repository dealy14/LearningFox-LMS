// JavaScript Document
	function checkPasswords(){
		var pass = document.getElementById('password').value;
		var pass_confirm = document.getElementById('pass_confirm').value;
		
		if(pass != "" && pass_confirm != ""){
			if(pass == pass_confirm){
				document.getElementById('passResult').innerHTML = "";
				window.badPassword = false;
			}else{
				document.getElementById('passResult').innerHTML = "Bad";
				window.badPassword = true;
			}
		}else if(pass == "" || pass_confirm == ""){
				document.getElementById('passResult').innerHTML = "Password must not be empty";
				window.badPassword = true;
		}else{
			window.badPassword = true;
		}
	}
	function check_form(){
		if(document.getElementById('username').value == ""){
			alert('Username must not be null');
			return false;
		}
		if(document.getElementById('password').value == ""){
			alert('Password must not be empty');
			return false;
		}
		if(document.getElementById('pass_confirm').value == ""){
			alert('Password Confirmation must not be empty');
			return false;
		}
		if(document.getElementById("email").value == ""){
			alert('Please enter an email');
			return false;
		}
		 if (document.email.value.length >0) {
			 i=document.email.value.indexOf("@")
			 j=document.email.value.indexOf(".",i)
			 k=document.email.value.indexOf(",")
			 kk=document.email.value.indexOf(" ")
			 jj=document.email.value.lastIndexOf(".")+1
			 len=document.email.value.length
		
			if (((i>0) && (j>(1+1)) && (k==-1) && (kk==-1) && (len-jj >=2) && (len-jj<=3)) == false) {
				alert("Please enter an exact email address.\n" +
				document.email.value + " is invalid.");
				return false;
		 	}
		 }
		 
	}