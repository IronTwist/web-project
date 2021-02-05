<?php
    require_once "../mywebsite/connection/connection.php";
    require_once "../mywebsite/includes/functions.php";
    session_start();
?>
<html>
<head>
<title>MyPlace</title>
<link rel="stylesheet" type="text/css" href="css/global.css" media="screen"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

</head>
 
<body>
<header class="header">
    <h1 class="bigTitle">MyPlace</h1>

    <span id="headerLogo" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </span>
</header>
<script type="text/javascript">
    error=0;
    if(getQueryVariable(error) == 1){
        alert();
    }

</script>
