<?php

ob_start();
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../config/config.php');
include_once ($filepath . '/../lib/Session.php');
Session::checkSession();
Session::destroy();
?>