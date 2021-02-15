<?php
    $root =$_SERVER['DOCUMENT_ROOT'];
    require $root."/connection/config.php";
    require $root."/includes/functions.php";
    require $root."/includes/model/User.class.php";

    session_start();
?>

<!-- Developer: Fratean Radu Razvan -->

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


</head>
 
<body>
<p class="logoText">MyPlace</p>
<header class="header">
    <?php if(isset($_SESSION["logo_pic"])){ ?>
    <div class="headerLogo" style="background-image: url(../uploads/admin/<?php echo "prew_". replaceSpaceWithBackslash($_SESSION["logo_pic"]); ?>" >
            &nbsp;
    </div>
    <?php }else{ ?>
        <div class="headerLogo">
            &nbsp;
        </div> 
    <?php } ?>   
    <?php
    
        if(isset($_SESSION)){
            if (isset($_SESSION["user"])) {
                echo "<div class=\"welcome\" >Welcome back, <span id=\"usernameLogo\">".$_SESSION["user"]->getUserName()."</span></div>";
            }else{
                echo "<div class=\"welcome\">Welcome to <span id=\"usernameLogo\">MyPlace</span></div>";
            }
        }
    ?> 
</header>
<?php require $root."/includes/navigation.php"; ?>

<script type="text/javascript">
    error=0;
    if(getQueryVariable(error) == 1){
        alert();
    }

</script>
