<?php

spl_autoload_register(function($className){

  include "$className.php";

});

$route = new Route;


?>