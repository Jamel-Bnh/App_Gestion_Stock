<?php
session_start();
require "link_db.php";
session_destroy();
header('Location:index.php');
?>