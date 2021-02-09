<?php
    $root =$_SERVER['DOCUMENT_ROOT'];
    require $root."/connection/config.php";
    require $root."/includes/functions.php";

    session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>MyPlace</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/global.css" media="screen"/>

<script src="/css/bootstrap-4.5.3-dist/js/jquery.min.js"></script>

 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="/css/bootstrap-4.5.3-dist/css/bootstrap.min.css" >

<script type="text/javascript">
    function getQueryVariable(variable){
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){
                   return pair[1];
                   }
       }
       return(false);
    }
</script>

<script>


let emailExist = 0;
function checkEmail(emailInput){
	var email=emailInput.value;
	var request=new XMLHttpRequest();
	request.onreadystatechange=function() {
		if (request.readyState == 4)
			if (request.status == 200){
				if(request.responseText=="1"){
					document.getElementById("email").style.backgroundColor="#52BE80";
                }    
				if(request.responseText=="0"){
					document.getElementById("email").style.backgroundColor="red";
                }
                emailExist=parseInt(request.responseText);
				// console.log("Email:"+email+", emailExist="+emailExist);
			}
			else 
                emailExist=parseInt(0);
	}
	request.open("GET","/includes/checkEmail.php?email="+email,true);
	request.send("");
}

</script>

</head>
 
<body>
<p class="logoText">MyPlace</p>
<header class="header">
    <div class="headerLogo">
            &nbsp;
    </div>
    <div class="welcome">
        Welcome back, Razvan!
    </div>
</header>
<?php require $root."/includes/navigation.php"; ?>

<script type="text/javascript">
    error=0;
    if(getQueryVariable(error) == 1){
        alert();
    }

</script>
