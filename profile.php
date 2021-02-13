<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."../includes/header.php";

if(isset($_SESSION["user"])){
    $userName = $_SESSION["user"];
}

?>
<div style="color: white;">
    <p>Username: <?php echo $userName->getUserName(); ?></p>
    <p>Email: <?php echo $userName->getEmail(); ?></p>
    <p>First name: <?php echo $userName->getFirstName(); ?></p>
    <p>Last name: <?php echo $userName->getLastName(); ?></p>
    <p>Birthday: <?php echo $userName->getBirthDay(); ?></p>
    <p>User privileges: <?php echo $userName->getLastName(); ?></p>
</div>

<?php
require_once $root."/includes/footer.php";
?>