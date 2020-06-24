<?php
require('config.php');
if($_GET['key']!=$key){header("HTTP/1.1 403 Forbidden");exit;}
require('worker.php');
?>
