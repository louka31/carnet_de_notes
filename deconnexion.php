<?php
session_start();
if(isset($_SESSION["login"]))
{
session_unset();
session_destroy();
header("Location: authentification.php");     
}else{
session_unset();
session_destroy();
header("Location: login.php");  
}

?>