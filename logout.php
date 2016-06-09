<?php
$access = 1;
require('resources/server/configuration.php');

session_destroy();
header('location: index.php');
?>