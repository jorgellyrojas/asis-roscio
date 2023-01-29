<?php
session_start();
session_destroy();
header("location:/asis-roscio/vista/login/login.php");
?>